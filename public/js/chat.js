$(document).ready(() => {
    const token = $("#_token").val();
    const firstUser = $("#firstUser").val();
    const secUser = $("#secUser").val();
    const AuthID = $("#AuthID").val();
    const chatName = $("#chatName").val();
    const currentUrl = "http://localhost:8000/";

    fetchMessage();

    $('#sharedMedia').click(()=> {
        $('#contactInfo').css('display','none');
        $('#displaySharedMedia').fadeIn();
    });
    $('#backDetail').click(()=> {
        $('#displaySharedMedia').css('display','none');
        $('#contactInfo').fadeIn();
    });

    $('#searchMessage').on('submit',(e) => {
        e.preventDefault();
        $.ajax({
            url: `/chat/message/search?searchMessage=${$('#searchMessageInput').val()}`,
            type: "GET",
            datatype: "json",
            success: function(res){
                $('div.displaySearchMessage').html("");
                $.each(res.searchMessage,(key,searchMessage) => {
                const dateString = searchMessage.created_at;
                const dateTime = new Date(dateString);
                function formatDate(date) {
                    var year = date.getFullYear();
                    var month = String(date.getMonth() + 1).padStart(2, '0');
                    var day = String(date.getDate()).padStart(2, '0');

                    return `${day}-${month}-${year}`;
                    }
                const formattedDate = formatDate(dateTime);

                $('div.displaySearchMessage').append(
                    `
                    <div class="list-unstyled  my-2 row lightTextClass ">
                        <li
                            class="my-1 lightTextClass text-start ">
                            <div class=" d-flex">

                            <div class=" pt-1" style="width: 40px">
                                ${searchMessage.image == null ? `
                                    <img src="${currentUrl+'image/defaultpic.jpg'}"
                                        alt="" class="w-100 rounded-circle">
                                `:`
                                    <img src="${currentUrl+'storage/' . searchMessage.image }"
                                        alt="" class="w-100 rounded-circle">
                                `}
                            </div>
                               <div class="col offset-1 text-start">
                               ${searchMessage.fir_user_id == AuthID ? `
                                <span class="  fw-bold">You</span>
                                `:`
                                <span class="  fw-bold">${chatName}</span>
                                `}
                                <br>
                                <span >${searchMessage.text}</span>
                               </div>
                               <div class="col-4 text-end">
                                    <small class="w-100 lightTextClass" style="font-size:smaller;">${formattedDate}</small>
                               </div>
                            </div>
                        </li>
                     </div>
                    `
                )
            })
            }
    })
})

    $("#sendMessageBtn").click((e) => {
        e.preventDefault();
        var messageInput = $(".messageInput").val();
        var messageData = {
            firstUser: firstUser,
            secUser: secUser,
            message: messageInput,
        };
        $.ajax({
            url: "/chat/message",
            type: "POST",
            datatype: "json",
            headers: {
                "X-CSRF-TOKEN": token,
            },
            data: messageData,
            success: function (res) {
                console.log("successfully sent");
                fetchMessage();
            },
        });
        $(".messageInput").val("");
    });

    $("#sendFile").click((e) => {
        e.preventDefault();
        $(".message-reply").html("");
        $("article").height("80vh");
        var messageInput1 = $(".messageInput1").val();
        var file = $("#file")[0].files[0];
        var fileForm = new FormData();
        fileForm.append("file", file);
        fileForm.append("firstUser", firstUser);
        fileForm.append("secUser", secUser);
        fileForm.append("message", messageInput1);

        if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/gif' || file.type == 'video/mp4' || file.type == 'video/webm' || file.type == 'video/ogg'){
            $.ajax({
                url: "/chat/message",
                type: "POST",
                datatype: "json",
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                data: fileForm,
                success: function (res) {
                    console.log("successfully sent");
                    fetchMessage();
                    $("#fileUpload").modal("hide");
                },
            });
        }else{
            $('#errorFile').append(
                `
                <small class=" text-danger">
                    Please upload a file in one of the given formats: <br>
                    [ jpeg , png , gif , mp4 , webm , ogg].
                 </small>
                `
            )
            $("#fileUpload").modal("show");
        }
    });

    // for audio message
    $.ajax({
        url: `/chat/ajax/${$("#chatID").val()}`,
        type: "GET",
        datatype: "json",
        contentType: false,
        processData: false,
        success: function (res) {
            var message = res.message;
            message.map((m) => {
                if (m.audio != null) {
                    const wavesurfer = WaveSurfer.create({
                        container: `span.waveform${m.chat_code}`,
                        waveColor: "#bbdefb",
                        progressColor: "#90caf9",
                        barWidth: 2,
                        responsive: true,
                        height: 40,
                        url: `http://localhost:8000/storage/${m.audio}`,
                    });
                    $(`button.${m.chat_code}.playBtn`).click(() => {
                        $(`button.${m.chat_code}.playBtn`).css(
                            "display",
                            "none"
                        );
                        $(`button.${m.chat_code}.pauseBtn`).css(
                            "display",
                            "inline"
                        );
                        wavesurfer.playPause();
                    });
                    $(`button.${m.chat_code}.pauseBtn`).click(() => {
                        $(`button.${m.chat_code}.pauseBtn`).css(
                            "display",
                            "none"
                        );
                        $(`button.${m.chat_code}.playBtn`).css(
                            "display",
                            "inline"
                        );
                        wavesurfer.playPause();
                    });
                }
            });
        },
    });

    // for voice record
    $(".voice-icon").click(() => {
        $(".messenge-send").css('display','none');
        $(".messenge-voice").fadeIn();
        $(".message-reply").html("");
        $("article").height("80vh");
        $('.audio-send').prop("disabled",true);
        startRecording();
    });
    $(".audio-stop").click(() => {
        stopRecording();
    });
    $(".back-send").click(() => {
        location.reload();
    });

    let mediaRecorder;
    let audioChunks = [];

    $(".audio-send").click(() => {
        $(".messenge-voice").fadeOut();
        $(".messenge-send").fadeIn();
        sendAudio();
        fetchMessage();
    });

    async function startRecording() {
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: true,
        });
        mediaRecorder = new MediaRecorder(stream);

        mediaRecorder.ondataavailable = (event) => {
            if (event.data.size > 0) {
                audioChunks.push(event.data);
            }
        };

        mediaRecorder.onstop = () => {
            $('.audio-send').prop("disabled",false);
        };

        mediaRecorder.start();
        console.log(mediaRecorder.state);
    }

    function sendAudio() {
        if (audioChunks.length === 0) {
            console.error("No audio data to send");
            return;
        }
        const audioBlob = new Blob(audioChunks, { type: "audio/wav" });

        const formData = new FormData();
        formData.append("audio", audioBlob, "recorded_audio.wav");
        formData.append("firstUser", firstUser);
        formData.append("secUser", secUser);

        $.ajax({
            url: "/chat/message",
            type: "POST",
            datatype: "json",
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": token,
            },
            data: formData,
        });
    }

    function stopRecording() {
        mediaRecorder.stop();
        console.log(mediaRecorder.state);
    }
});

function fetchMessage() {
    var messages;

    $.ajax({
        url: `/chat/ajax/${$("#chatID").val()}`,
        type: "GET",
        datatype: "json",
        contentType: false,
        processData: false,
        success: function (res) {

            $("article").html("");


            messages = res.message;
            $.each(res.message, (key, m) => {
                const AuthID = $("#AuthID").val();
                const chatDefImage = $("#chatDefImage").attr("src");
                const chatImage = $("#chatImages").attr("src");
                const currentUrl = "http://localhost:8000/";

                const dateString = m.created_at;
                const dateTime = new Date(dateString);
                function formatDate(date) {
                    var hours = String(date.getHours()).padStart(2, "0");
                    var minutes = String(date.getMinutes()).padStart(2, "0");

                    var ChangeAmPm =
                        hours <= 12
                            ? `${hours}:${minutes} am`
                            : `${hours - 12}:${minutes} pm`;

                    return ChangeAmPm;
                }
                const formattedDate = formatDate(dateTime);



                $("article").append(`
                    ${
                        AuthID == m.fir_user_id
                            ? `
                   <div class=" d-flex ">
                   <div style="margin-left: auto">

                       ${
                           m.text == null &&
                           m.image == null &&
                           m.audio == null &&
                           m.video == null
                               ? `
                           <div class="clickToReply my-3">
                               <div class=" text-end py-2 ">
                                   <small class="reply pe-3" style=" display:none;font-size: smaller">
                                       <a><i
                                               class="fa-solid fa-trash perDelete opacity-50 lightTextClass ${
                                                   m.chat_code
                                               }"></i></a>
                                   </small>
                                   <small class="lightTextClass" style="font-size: smaller">
                                       ${
                                           m.status == "sent"
                                               ? `
                                           <i class="fa-regular fa-circle-check px-2"></i>
                                       `
                                               : `
                                           <i class="fa-solid fa-circle-check px-2"></i>
                                       `
                                       }
                                   </small>
                                   <small class=" lightTextClass pe-3"
                                       style="font-size: smaller">${formattedDate}</small>
                                   <span
                                       class=" rounded-bottom-3 rounded-start-3 mt-4 lightTextClass text-end px-4 py-2 "
                                       style="border: 1px solid #e3f2fd">You removed message</span>
                               </div>
                           </div>
                           `
                               : `
                           ${
                               m.audio != null
                                   ? `
                               <div class=" clickToReply py-2">

                                   <div class="d-flex">

                                       <div class=" mt-4">
                                           <small class="reply " style=" display:none;font-size: smaller">

                                               <a><i
                                                       class="fa-solid fa-trash opacity-50 ps-2 lightTextClass ${
                                                           m.chat_code
                                                       }"></i></a>
                                           </small>
                                           <small class="lightTextClass" style="font-size: smaller">
                                              ${
                                                  m.status == "sent"
                                                      ? `
                                                   <i class="fa-regular fa-circle-check px-2"></i>
                                              `
                                                      : `
                                                   <i class="fa-solid fa-circle-check px-2"></i>
                                                `
                                              }
                                           </small>
                                           <small class=" lightTextClass me-4"
                                               style="font-size: smaller">${formattedDate}</small>
                                       </div>

                                       <audio controls class="d-none ${
                                           m.chat_code
                                       }">
                                           <source src="${
                                               currentUrl + "storage/" + m.audio
                                           }" type="audio/mpeg">
                                       </audio>

                                       <div class="d-flex  px-3 rounded-bottom-3 rounded-start-3"
                                           style="background-color: #e3f2fd;width:300px">
                                           <button type="button"
                                               class=" ${
                                                   m.chat_code
                                               } playBtn btn text-white-50 my-3"
                                               style="background-color: #bbdefb;width:35px"><i
                                                   class="fa-solid fa-play"></i>
                                           </button>
                                           <button type="button"
                                               class=" ${
                                                   m.chat_code
                                               } pauseBtn btn text-white-50 my-3 "
                                               style="background-color: #bbdefb; width:35px; display: none"><i
                                                   class="fa-solid fa-pause"></i>
                                           </button>
                                           <span class=" ms-3 mt-3 waveform${
                                               m.chat_code
                                           }"
                                               style="width: 150px"></span>
                                       </div>
                                   </div>
                               </div>
                           `
                                   : `
                               ${
                                   m.image == null && m.video == null
                                       ? `
                                   <div class="clickToReply  py-3">
                                       <div class=" text-end">
                                       ${
                                           m.reply_chat_code != null
                                               ? ` <div class="mb-1 ${m.fir_user_id == AuthID ? 'd-flex' : ''}">
                                               <div style="${m.fir_user_id == AuthID ? 'margin-left:auto' : '' }">
                                               ${
                                                   m.fir_user_id == AuthID
                                                       ? `
                                                       <small
                                                           class=" lightTextClass d-block mb-2 ${m.fir_user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                           style="font-size: smaller">Replied to yourself</small>
                                                           `
                                                       : `
                                                       <small
                                                           class=" lightTextClass d-block mb-2 ${m.fir_user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                           style="font-size: smaller">Replied to ${m.fir_user_id == AuthID ? chatName : 'themselves' }</small>
                                                           `
                                               }
                                               <div class=" col mb-1">
                                               ${m.reply_mes.length <= 40 ? `
                                                   <span
                                                       class=" opacity-25 rounded-3 border-0 lightTextClass ${m.fir_user_id == AuthID ? 'text-end' : '' } px-4 py-2"
                                                       style="background-color: #e3f2fd;"><span
                                                           class=" ps-3"
                                                           style="border-left:2px solid black">
                                                       ${m.reply_mes}
                                                    </span>
                                                   </span>
                                                   `: `
                                                   <p
                                                       class=" opacity-25 rounded-3 border-0 offset-2 lightTextClass ${m.fir_user_id == AuthID ? 'text-end' : '' } px-4 py-2"
                                                       style="background-color: #e3f2fd;"><span
                                                           class=" ps-3">
                                                       ${m.reply_mes}
                                                    </span>
                                                   </p>
                                                   `}
                                               </div>
                                               </div>
                                           </div>`
                                               : ""
                                       }
                                       ${m.text.length <= 40 ? `
                                           <small class="reply " style=" display:none;font-size: smaller">
                                               <a><i
                                                       class="fa-solid fa-reply opacity-50 lightTextClass ${
                                                           m.chat_code
                                                       }" ></i></ai>
                                               <a><i
                                                       class="fa-solid fa-trash  opacity-50 ps-2 lightTextClass ${
                                                           m.chat_code
                                                       }" ></i></a>
                                           </small>
                                           <small class="lightTextClass" style="font-size: smaller">
                                           ${
                                               m.status == "sent"
                                                   ? `
                                                   <i class="fa-regular fa-circle-check px-2"></i>
                                                   `
                                                   : `
                                                   <i class="fa-solid fa-circle-check px-2"></i>
                                                   `
                                           }
                                           </small>
                                           <small class=" lightTextClass pe-3"
                                               style="font-size: smaller">${formattedDate}</small>
                                           <span
                                               class=" rounded-bottom-3 rounded-start-3 border-0 mt-4 lightTextClass text-end px-4 py-2"
                                               style="background-color: #e3f2fd"><span>${
                                                   m.text
                                               }</span>
                                           </span>
                                           ` : `
                                           <p
                                                class=" rounded-bottom-3 rounded-start-3 offset-2 border-0 lightTextClass text-end px-4 py-2"
                                                style="background-color: #e3f2fd;"><span>${
                                                    m.text
                                                }</span>
                                            </p>

                                            <small class="reply " style=" display:none;font-size: smaller">
                                               <a><i
                                                       class="fa-solid fa-reply opacity-50 lightTextClass ${
                                                           m.chat_code
                                                       }" ></i></ai>
                                               <a><i
                                                       class="fa-solid fa-trash  opacity-50 ps-2 lightTextClass ${
                                                           m.chat_code
                                                       }" ></i></a>
                                           </small>
                                           <small class="lightTextClass" style="font-size: smaller">
                                           ${
                                               m.status == "sent"
                                                   ? `
                                                   <i class="fa-regular fa-circle-check px-2"></i>
                                                   `
                                                   : `
                                                   <i class="fa-solid fa-circle-check px-2"></i>
                                                   `
                                           }
                                           </small>
                                           <small class=" lightTextClass pe-3"
                                           style="font-size: smaller">${formattedDate}</small>
                                           `}
                                       </div>
                                   </div>
                               `
                                       : `
                                   ${
                                       m.text == null
                                           ? `
                                       ${
                                           m.video == null && m.image != null
                                               ? `
                                           <div class="clickToReply">
                                               <div class=" py-2">


                                                   <div class=" rounded-bottom-3 rounded-start-3 border-0  px-4 py-2"
                                                       style="background-color: #e3f2fd; width:200px;">

                                                       <img src="${
                                                           currentUrl +
                                                           "storage/" +
                                                           m.image
                                                       }"
                                                           class="w-100 rounded-3" alt="">

                                                   </div>

                                                   <div>
                                                   <small class="lightTextClass" style="font-size: smaller">
                                                   ${
                                                       m.status == "sent"
                                                           ? `
                                                           <i class="fa-regular fa-circle-check px-2"></i>
                                                           `
                                                           : `
                                                           <i class="fa-solid fa-circle-check px-2"></i>
                                                           `
                                                   }
                                                       </small>
                                                       <small class=" lightTextClass pe-2"
                                                           style="font-size: smaller">${formattedDate}</small>
                                                       <small class="reply"
                                                           style=" display:none;font-size: smaller">

                                                           <a><i
                                                                   class="fa-solid fa-trash  opacity-50 ps-2 lightTextClass ${
                                                                       m.chat_code
                                                                   }"></i></a>
                                                       </small>
                                                   </div>

                                               </div>
                                           </div>
                                       `
                                               : m.video != null &&
                                                 m.image == null
                                               ? `
                                           <div class="clickToReply py-2">


                                               <div class=" rounded-bottom-3 rounded-start-3 border-0 py-2 d-flex justify-content-center"
                                                   style="background-color: #e3f2fd; width:150px;"
                                                   data-bs-toggle="modal" data-bs-target="#${
                                                       m.chat_code
                                                   }">

                                                   <div class=" position-relative">
                                                       <video width="100" height="90"
                                                           class="rounded-3 bg-light" id="video">
                                                           <source src="${
                                                               currentUrl +
                                                               "storage/" +
                                                               m.video
                                                           }
                                                               type="video/mp4">
                                                           <source src="${
                                                               currentUrl +
                                                               "storage/" +
                                                               m.video
                                                           }
                                                               type="video/ogg">
                                                           Your browser does not support the video tag.
                                                       </video>
                                                       <i class="fa-solid fa-circle-play position-absolute text-white fs-4"
                                                           style="top: 35%; left: 40%"></i>
                                                   </div>
                                               </div>

                                               <div class="modal fade" id="${
                                                   m.chat_code
                                               }" tabindex="-1"
                                                   role="dialog" aria-labelledby="videoDisplay"
                                                   aria-hidden="true">
                                                   <button type="button"
                                                       class="btn position-absolute top-0 end-0 me-3 mt-2"
                                                       data-bs-dismiss="modal"><i
                                                           class="fa-solid fa-xmark text-white"></i></button>
                                                   <div class="modal-dialog modal-dialog-centered"
                                                       role="document" style="width: 300px">
                                                       <div class="modal-content">

                                                           <video width="200" height="180"
                                                               class="rounded-3 bg-light w-100" id="video"
                                                               controls>
                                                               <source src="${
                                                                   currentUrl +
                                                                   "storage/" +
                                                                   m.video
                                                               }"
                                                                   type="video/mp4">
                                                               <source src="${
                                                                   currentUrl +
                                                                   "storage/" +
                                                                   m.video
                                                               }"
                                                                   type="video/ogg">
                                                               Your browser does not support the video tag.
                                                           </video>

                                                       </div>
                                                   </div>
                                               </div>

                                               <div>
                                                    <small class="lightTextClass" style="font-size: smaller">
                                                        ${
                                                            m.status == "sent"
                                                                ? `
                                                                <i class="fa-regular fa-circle-check px-2"></i>
                                                                `
                                                                : `
                                                                <i class="fa-solid fa-circle-check px-2"></i>
                                                                `
                                                        }
                                                   </small>
                                                   <small class=" lightTextClass pe-2"
                                                       style="font-size: smaller">${formattedDate}</small>
                                                   <small class="reply"
                                                       style="display:none;font-size: smaller">

                                                       <a><i
                                                               class="fa-solid fa-trash ps-2 opacity-50 lightTextClass ${
                                                                   m.chat_code
                                                               }"></i></a>
                                                   </small>
                                               </div>
                                           </div>
                                       `
                                               : ""
                                       }
                                   `
                                           : `
                                       ${
                                           m.image == null && m.video != null
                                               ? `
                                           <div class=" clickToReply py-2">


                                                   <div class=" rounded-bottom-3 rounded-start-3 border-0 text-start"
                                                       style="background-color: #e3f2fd;">
                                                       <span
                                                           class=" lightTextClass px-4 ">${
                                                               m.text
                                                           }</span>

                                                       <div class="d-flex justify-content-center mt-1"
                                                           style="background-color: #e3f2fd; width:150px;"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#${
                                                               m.chat_code
                                                           }">

                                                           <div class=" position-relative">
                                                               <video width="100" height="90"
                                                                   class="rounded-3 bg-light" id="video">
                                                                   <source
                                                                       src="${
                                                                           currentUrl +
                                                                           "storage/" +
                                                                           m.video
                                                                       }"
                                                                       type="video/mp4">
                                                                   <source
                                                                       src="${
                                                                           currentUrl +
                                                                           "storage/" +
                                                                           m.video
                                                                       }"
                                                                       type="video/ogg">
                                                                   Your browser does not support the video tag.
                                                               </video>
                                                               <i class="fa-solid fa-circle-play position-absolute text-white fs-4"
                                                                   style="top: 35%; left: 40%"></i>
                                                           </div>
                                                       </div>


                                                       <div class="modal fade" id="${
                                                           m.chat_code
                                                       }"
                                                           tabindex="-1" role="dialog"
                                                           aria-labelledby="videoDisplay" aria-hidden="true">
                                                           <button type="button"
                                                               class="btn position-absolute top-0 end-0 me-3 mt-2"
                                                               data-bs-dismiss="modal"><i
                                                                   class="fa-solid fa-xmark text-white"></i></button>
                                                           <div class="modal-dialog modal-dialog-centered"
                                                               role="document" style="width: 300px">
                                                               <div class="modal-content">

                                                                   <video width="200" height="180"
                                                                       class="rounded-3 bg-light w-100"
                                                                       id="video" controls>
                                                                       <source
                                                                           src="${
                                                                               currentUrl +
                                                                               "storage/" +
                                                                               m.video
                                                                           }"
                                                                           type="video/mp4">
                                                                       <source
                                                                           src="${
                                                                               currentUrl +
                                                                               "storage/" +
                                                                               m.video
                                                                           }"
                                                                           type="video/ogg">
                                                                       Your browser does not support the video tag.
                                                                   </video>

                                                               </div>
                                                           </div>
                                                        </div>

                                                   </div>

                                               <div>
                                                   <small class="lightTextClass" style="font-size: smaller">
                                                   ${
                                                       m.status == "sent"
                                                           ? `
                                                           <i class="fa-regular fa-circle-check px-2"></i>
                                                           `
                                                           : `
                                                           <i class="fa-solid fa-circle-check px-2"></i>
                                                           `
                                                   }
                                                   </small>
                                                   <small class=" lightTextClass pe-2"
                                                       style="font-size: smaller">${formattedDate}</small>
                                                   <small class="reply"
                                                       style=" display:none;font-size: smaller">

                                                       <a
                                                         ><i
                                                               class="fa-solid fa-trash ps-2 opacity-50 lightTextClass ${
                                                                   m.chat_code
                                                               }" ></i></a>
                                                   </small>
                                               </div>
                                               </div>
                                           </div>
                                       `
                                               : m.image != null &&
                                                 m.video == null
                                               ? `
                                           <div class=" clickToReply py-2">



                                                <div class=" rounded-bottom-3 rounded-start-3 border-0 px-4 py-2 text-start"
                                                       style="background-color: #e3f2fd; width:200px;">
                                                       <span class=" lightTextClass">${
                                                           m.text
                                                       }</span>
                                                       <img src="${
                                                           currentUrl +
                                                           "storage/" +
                                                           m.image
                                                       }"
                                                           class="w-100 rounded-3 mt-1" alt="">

                                                </div>

                                               <div>
                                                    <small class="lightTextClass" style="font-size: smaller">
                                                        ${
                                                            m.status == "sent"
                                                                ? `
                                                                <i class="fa-regular fa-circle-check px-2"></i>
                                                                `
                                                                : `
                                                                <i class="fa-solid fa-circle-check px-2"></i>
                                                                `
                                                        }
                                                   </small>
                                                   <small class=" lightTextClass pe-2"
                                                       style="font-size: smaller">${formattedDate}</small>
                                                   <small class="reply"
                                                       style=" display:none;font-size: smaller">

                                                       <a><i
                                                               class="fa-solid fa-trash ps-2 opacity-50 lightTextClass ${
                                                                   m.chat_code
                                                               }"></i></a>
                                                   </small>
                                               </div>

                                           </div>
                                       `
                                               : ""
                                       }
                                   `
                                   }
                               `
                               }
                           `
                           }
                        `
                       }
                   </div>
               </div>
                   `
                            : AuthID == m.sec_user_id
                            ? `
                   <div class=" row">
                       <div class="my-2" style="width:60px">
                              ${
                                  chatDefImage == undefined &&
                                  chatImage == undefined
                                      ? `
                                   <img src="${
                                       currentUrl + "image/defaultpic.jpg"
                                   }" class="w-100 rounded-circle"
                                       alt="">
                                       `
                                      : chatImage != undefined
                                      ? `
                               <img src="${chatImage}" class="w-100 rounded-circle"
                                   alt="">
                               `
                                      : chatDefImage != undefined
                                      ? `
                               <img src="${chatDefImage}" class="w-100 rounded-circle"
                                   alt="">
                           `
                                      : ""
                              }

                       </div>

                       ${
                           m.text == null &&
                           m.image == null &&
                           m.audio == null &&
                           m.video == null
                               ? `
                        <div class="clickToReply col my-3">


                                <span
                                    class=" rounded-bottom-3 rounded-end-3 mt-4 lightTextClass px-4 py-2 "
                                    style="border: 1px solid #eeeeee">Deleted message</span>
                                    <small class=" lightTextClass ps-3"
                                    style="font-size: smaller">${formattedDate}</small>
                                    <small class="reply ps-3" style=" display:none;font-size: smaller">
                                    <a><i
                                            class="fa-solid fa-reply opacity-50 lightTextClass ${
                                                m.chat_code
                                            }"></i></a>
                                </small>

                        </div>
                        `
                               : `
                            ${
                                m.audio != null
                                    ? `
                               <div class=" clickToReply col py-2">

                                   <div class="d-flex">
                                   <div class="d-flex  px-3 rounded-bottom-3 rounded-end-3"
                                   style="background-color: #eeeeee;width:300px">
                                   <button type="button"
                                       class=" ${
                                           m.chat_code
                                       } playBtn btn text-white-50 my-3"
                                       style="background-color: #bdbdbd;width:35px"><i
                                           class="fa-solid fa-play"></i>
                                   </button>
                                   <button type="button"
                                       class=" ${
                                           m.chat_code
                                       } pauseBtn btn text-white-50 my-3 "
                                       style="background-color: #bdbdbd; width:35px; display: none"><i
                                           class="fa-solid fa-pause"></i>
                                   </button>
                                   <span class=" ms-3 mt-3 waveform${
                                       m.chat_code
                                   }"
                                       style="width: 150px"></span>
                               </div>

                                       <div class=" mt-4">
                                       <small class=" lightTextClass ms-3"
                                       style="font-size: smaller">${formattedDate}</small>


                                       </div>

                                       <audio controls class="d-none ${
                                           m.chat_code
                                       }">
                                        <source src="${
                                            currentUrl + "storage/" + m.audio
                                        }" type="audio/mpeg">
                                    </audio>


                                   </div>
                               </div>
                               `
                                    : `
                           ${
                               m.image == null && m.video == null
                                   ? `
                                <div class="clickToReply col py-3">
                                    <div class="">
                                    ${
                                        m.reply_chat_code != null
                                            ? ` <div class="mb-1 ${m.fir_user_id == AuthID ? 'd-flex' : ''}">
                                            <div style="${m.fir_user_id == AuthID ? 'margin-left:auto' : '' }">
                                            ${
                                                m.fir_user_id == AuthID
                                                    ? `
                                                    <small
                                                        class=" lightTextClass d-block mb-2 ${m.fir_user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                        style="font-size: smaller">Replied to yourself</small>
                                                        `
                                                    : `
                                                    <small
                                                        class=" lightTextClass d-block mb-2 ${m.fir_user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                        style="font-size: smaller">Replied to ${m.fir_user_id == AuthID ? chatName : 'themselves' }</small>
                                                        `
                                            }
                                            <div class="  mb-2">
                                            ${m.reply_mes.length <= 40 ? `

                                                <span
                                                    class=" opacity-25 rounded-3 border-0  lightTextClass ${m.fir_user_id == AuthID ? 'text-end' : '' } px-4 py-2"
                                                    style="background-color: #e3f2fd;"><span
                                                        class=" ps-3"
                                                        style="border-left:2px solid black">
                                                    ${m.reply_mes}
                                                    </span>
                                                </span>
                                                `: `
                                                <p
                                                    class=" opacity-25 rounded-3 border-0 col-10 lightTextClass ${m.fir_user_id == AuthID ? 'text-end' : '' } px-4 py-2"
                                                    style="background-color: #e3f2fd;"><span
                                                        class=" ps-3">
                                                    ${m.reply_mes}
                                                    </span>
                                                </p>
                                                `}
                                            </div>
                                            </div>
                                        </div>`
                                            : ""
                                    }
                                       ${m.text.length <= 40 ? `
                                    <span
                                        class=" rounded-bottom-3 rounded-end-3 border-0 mt-4 lightTextClass px-4 py-2"
                                        style="background-color: #eeeeee"><span>${
                                            m.text
                                        }</span>
                                    </span>
                                    `:`
                                    <p
                                        class=" rounded-bottom-3 rounded-end-3 border-0 col-10 lightTextClass px-4 py-2"
                                        style="background-color: #eeeeee"><span>${
                                            m.text
                                        }</span>
                                    </p>
                                        `}

                                <small class=" lightTextClass ps-3"
                                style="font-size: smaller">${formattedDate}</small>

                                        <small class="reply ms-2" style=" display:none;font-size: smaller">
                                        <a><i
                                        class="fa-solid fa-reply opacity-50 lightTextClass ${
                                            m.chat_code
                                        }" ></i></a>
                                        </small>

                                   </div>
                                </div>
                                `
                                   : `
                            ${
                                m.text == null
                                    ? `
                                ${
                                    m.video == null && m.image != null
                                        ? `
                                        <div class="clickToReply col py-2">


                                        <div class=" rounded-bottom-3 rounded-end-3 border-0  px-4 py-2"
                                        style="background-color: #eeeeee; width:200px;">

                                        <img src="${
                                            currentUrl + "storage/" + m.image
                                        }"
                                            class="w-100 rounded-3" alt="">

                                    </div>
                                            <div>

                                            <small class=" lightTextClass ps-2"
                                            style="font-size: smaller">${formattedDate}</small>

                                            </div>

                                            </div>
                                        </div>
                                        `
                                        : m.video != null && m.image == null
                                        ? `
                                        <div class="clickToReply col py-2">

                                            <div class="rounded-bottom-3 rounded-end-3 border-0 py-2"  style="background-color: #eeeeee; width:150px;">


                                                <div class="  d-flex justify-content-center"  style="background-color: #eeeeee;"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#${
                                                                m.chat_code
                                                            }">

                                                    <div class=" position-relative">
                                                        <video width="100" height="90" class="rounded-3 bg-light" id="video">
                                                        <source src="${
                                                            currentUrl +
                                                            "storage/" +
                                                            m.video
                                                        }
                                                            type="video/mp4">
                                                        <source src="${
                                                            currentUrl +
                                                            "storage/" +
                                                            m.video
                                                        }
                                                            type="video/ogg">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <i class="fa-solid fa-circle-play position-absolute text-white fs-4"
                                                                    style="top: 35%; left: 40%"></i>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="${
                                                    m.chat_code
                                                }" tabindex="-1" role="dialog"
                                                        aria-labelledby="videoDisplay" aria-hidden="true">

                                                    <button type="button" class="btn position-absolute top-0 end-0 me-3 mt-2"
                                                        data-bs-dismiss="modal"><i class="fa-solid fa-xmark text-white"></i></button>
                                                    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 300px">
                                                        <div class="modal-content">
                                                        <video width="200" height="180" class="rounded-3 bg-light w-100" id="video"
                                                            controls>
                                                            <source src="${
                                                                currentUrl +
                                                                "storage/" +
                                                                m.video
                                                            }"
                                                                type="video/mp4">
                                                            <source src="${
                                                                currentUrl +
                                                                "storage/" +
                                                                m.video
                                                            }"
                                                                type="video/ogg">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>

                                            <small class=" lightTextClass ps-2"
                                            style="font-size: smaller">${formattedDate}</small>
                                                <small class="reply" style=" display:none;font-size: smaller">


                                            </small>
                                        </div>
                                    </div>
                                    `
                                        : ""
                                }
                        `
                                    : `
                            ${
                                m.image == null && m.video != null
                                    ? `
                                <div class=" clickToReply col py-2">


                                <div class=" rounded-bottom-3 rounded-end-3 border-0" style="background-color: #eeeeee; width:150px">
                                        <span class=" lightTextClass px-4 ">${
                                            m.text
                                        }</span>
                                    <div class="d-flex justify-content-center mt-1" style="background-color: #eeeeee;"
                                        data-bs-toggle="modal" data-bs-target="#${
                                            m.chat_code
                                        }">
                                        <div class=" position-relative">
                                            <video width="100" height="90" class="rounded-3 bg-light" id="video">
                                            <source
                                            src="${
                                                currentUrl +
                                                "storage/" +
                                                m.video
                                            }"
                                            type="video/mp4">
                                        <source
                                            src="${
                                                currentUrl +
                                                "storage/" +
                                                m.video
                                            }"
                                            type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <i class="fa-solid fa-circle-play position-absolute text-white fs-4"
                                                style="top: 35%; left: 40%"></i>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="${
                                        m.chat_code
                                    }" tabindex="-1" role="dialog"
                                        aria-labelledby="videoDisplay" aria-hidden="true">
                                        <button type="button" class="btn position-absolute top-0 end-0 me-3 mt-2"
                                            data-bs-dismiss="modal"><i class="fa-solid fa-xmark text-white"></i></button>
                                        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 300px">
                                            <div class="modal-content">
                                                <video width="200" height="180" class="rounded-3 bg-light w-100" id="video"
                                                    controls>
                                                    <source
                                                   src="${
                                                       currentUrl +
                                                       "storage/" +
                                                       m.video
                                                   }"
                                                   type="video/mp4">
                                               <source
                                                   src="${
                                                       currentUrl +
                                                       "storage/" +
                                                       m.video
                                                   }"
                                                   type="video/ogg">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div>
                                    <small class=" lightTextClass ps-2"
                                    style="font-size: smaller">${formattedDate}</small>


                                    </div>

                                </div>
               `
                                    : m.image != null && m.video == null
                                    ? `
                                    <div class=" clickToReply col py-2">



                                    <div class=" rounded-bottom-3 rounded-end-3 border-0  px-4 py-2"
                                        style="background-color: #eeeeee; width:200px;">
                                        <span class=" lightTextClass">${
                                            m.text
                                        }</span>
                                        <img src="${
                                            currentUrl + "storage/" + m.image
                                        }"
                                            class="w-100 rounded-3 mt-1" alt="">
                                    </div>

                                    <div>

                                    <small class=" lightTextClass ps-2"
                                    style="font-size: smaller">${formattedDate}</small>

                                    </div>

                                    </div>
                        `
                                    : ""
                            }
            `
                            }
            `
                           }
            `
                            }
            `
                       }
                        </div>

                   `
                            : ""
                    }
                   `);
            });

            $.each(messages, (key, msg) => {
            $(`.fa-reply.${msg.chat_code}`).click(() => {
               $("#sendMessageBtn").css("display", "none");
               $("#sendMessageBtn1").css("display", "inline");
               $("#sendFile").css("display", "none");
               $("#sendFile1").css("display", "inline");


               const AuthID = $("#AuthID").val();
               const token = $("#_token").val();
               const firstUser = $("#firstUser").val();
               const secUser = $("#secUser").val();
               const chatName = $("#chatName").val();
               const currentUrl = "http://localhost:8000/";

               $.ajax({
                   url: `/chat/message/reply/${msg.chat_code}`,
                   type: "GET",
                   datatype: "json",
                   contentType: false,
                   processData: false,
                   success: function (res) {
                       var reply = res.reply;

                       $(".message-reply").html("");
                       $(".message-reply").append(
                           `
                           <div id="replyText">
                           <input type="hidden" name="replyCode" id="replyCode" value=${
                               msg.chat_code
                           }>
                           <input type="hidden" name="replyMes" id="replyText" value=${
                            reply.text
                        }>

                        <div class=" px-4 py-2 rounded-top-3 lightTextClass"
                        style=" background-color: #eeeeee;">
                        ${
                            reply.sec_user_id == AuthID
                                ? `
                            <small class=" col lightTextClass" style="font-size: smaller">Replying
                                to
                                ${chatName}</small>
                                `
                                : `
                            <small class=" col lightTextClass" style="font-size: smaller">Replying
                                to
                                yourself</small>
                                `
                        }
                        <a><i
                                class="fa-solid fa-xmark lightTextClass offset-9 col-1 ps-5 closeReply"></i></a>
                        <span class=" ps-3 d-block opacity-50"
                            style=" border-left:2px solid #eeeeee;">
                            ${reply.text}
                        </span>
                        <input type="hidden" name="replyMes" id="replyText" value=${
                         reply.text
                     }>
                    </div>
                       </div>  `
                       );

                       $('.closeReply').click(() => {
                           $("#sendMessageBtn").css("display", "inline");
                           $("#sendMessageBtn1").css("display", "none");

                           $("#sendFile").css("display", "inline");
                           $("#sendFile1").css("display", "none");

                           $(".message-reply").html("");
                           $("article").height("80vh");
                       })

                       $("#sendMessageBtn1").one("click", (e) => {
                           e.preventDefault();
                           var messageInput = $(".messageInput").val();
                           var messageData = {
                               firstUser: firstUser,
                               secUser: secUser,
                               replyCode: reply.chat_code,
                               replyText: reply.text,
                               replyAudio: reply.audio,
                               replyVideo: reply.video,
                               replyImage: reply.image,
                               message: messageInput,
                           };
                           $.ajax({
                               url: "/chat/message",
                               type: "POST",
                               datatype: "json",
                               headers: {
                                   "X-CSRF-TOKEN": token,
                               },
                               data: messageData,
                               success: function (res) {
                                   console.log("successfully sent");
                                   fetchMessage();
                               },
                           });
                           $("#sendMessageBtn1").css("display", "none");
                           $("#sendMessageBtn").css("display", "inline");
                           $(".message-reply").html("");
                           $("article").height("80vh");
                           $(".messageInput").val("");
                       });



                       reply.audio == null
                           ? reply.text == null
                               ? $("article").height("60vh")
                               : $("article").height("71vh")
                           : $("article").height("71vh");
                        },
                    });
                });

                $(`.fa-trash.${msg.chat_code}`).click(() => {
                    $.ajax({
                        url: `/chat/message/delete/${msg.chat_code}`,
                        type: "GET",
                        datatype: "json",
                        success: function (res) {
                            console.log('successfully removed');
                            fetchMessage();
                        }
                    })
                });

                $(`.fa-trash.perDelete.${msg.chat_code}`).click(() => {
                    $.ajax({
                        url: `/chat/message/delete/par/${msg.chat_code}`,
                        type: "GET",
                        datatype: "json",
                        success: function (res) {
                            console.log('successfully removed');
                            fetchMessage();
                        }
                    })
                })
            });



            $(".clickToReply").click(function () {
                $(this).find(".reply").fadeToggle();
                $(".reply").not($(this).find(".reply")).fadeOut();
            });

            var element = document.getElementById("scroll");
            var scrolled = false;

            function updateScroll() {
                if (!scrolled) {
                    element.scrollTop = element.scrollHeight;
                }
            }
            $("#scroll").on("scroll", function () {
                scrolled = true;
            });

            setInterval(updateScroll, 1000);
            $("#scrollDown").click(function () {
                $("#scroll").animate(
                    {
                        scrollTop: $("#scroll")[0].scrollHeight,
                    },
                    1000
                );
            });
        },
    });

      // $.ajax({
    //     url: `/chat/ajax/${$("#chatID").val()}`,
    //     type: "GET",
    //     datatype: "json",
    //     contentType: false,
    //     processData: false,
    //     success: function (res) {

//     }
// })




    // console.log(replyChatCode);
    // console.log(messageFirUserID);
    // console.log(replyContext);
    // console.log(chatCode);
}

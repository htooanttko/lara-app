$(document).ready(() => {
    const token = $("#_token").val();
    const groupID = $("#groupID").val();
    const AuthID = $("#AuthID").val();
    const user = $("#user").val();
    const firstUser = $("#firstUser").val();
    const secUser = $("#secUser").val();
    const aUser = $("#aUser").val();
    const bUser = $("#bUser").val();
    const cUser = $("#cUser").val();
    const dUser = $("#dUser").val();
    const eUser = $("#eUser").val();
    const fUser = $("#fUser").val();
    const gUser = $("#gUser").val();
    const hUser = $("#hUser").val();

    fetchMessage();

     $('#member').click(()=> {
        $('#groupInfo').css('display','none');
        $('#displayMember').fadeIn();
    });
    $('#backMember').click(()=> {
        $('#displayMember').css('display','none');
        $('#groupInfo').fadeIn();
    });

    $('#sharedMedia').click(()=> {
        $('#contactInfo').css('display','none');
        $('#displaySharedMedia').fadeIn();
    });
    $('#backDetail').click(()=> {
        $('#displaySharedMedia').css('display','none');
        $('#contactInfo').fadeIn();
    });

    $.ajax({
        url: `/block/member/ajax`,
        type: "GET",
        datatype: "json",
        success: function(res){
            var block = res.block[0].blocked_id;

            if(block == user && user == undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == firstUser && firstUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == secUser && secUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == aUser && aUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == bUser && bUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == cUser && cUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == dUser && dUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == eUser && eUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == fUser && fUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == gUser && gUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
            if(block == hUser && hUser != undefined){
                $('#confirmBlockedMember').modal('show');
            }
        }
    })

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

     $('#sharedMedia').click(()=> {
        $('#groupInfo').css('display','none');
        $('#displaySharedMedia').fadeIn();
    });
    $('#backDetail').click(()=> {
        $('#displaySharedMedia').css('display','none');
        $('#groupInfo').fadeIn();
    });

    $("#sendMessageBtn").click((e) => {
        e.preventDefault();
        var messageInput = $(".messageInput").val();
        var messageData = {
            gpID: groupID,
            userId: AuthID,
            firstUser: firstUser,
            secUser: secUser,
            aUser: aUser,
            bUser: bUser,
            cUser: cUser,
            dUser: dUser,
            eUser: eUser,
            fUser: fUser,
            gUser: gUser,
            hUser: hUser,
            message: messageInput,
        };
        $.ajax({
            url: "/group/message",
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
        var messageInput1 = $(".messageInput1").val();
        var file = $("#file")[0].files[0];
        var fileForm = new FormData();
        fileForm.append("file", file);
        fileForm.append("gpID", groupID);
        fileForm.append("userId", AuthID);
        fileForm.append("message", messageInput1);
        fileForm.append("firstUser", firstUser);
        fileForm.append("secUser", secUser);
        fileForm.append("aUser", aUser);
        fileForm.append("bUser", bUser);
        fileForm.append("cUser", cUser);
        fileForm.append("dUser", dUser);
        fileForm.append("eUser", eUser);
        fileForm.append("fUser", fUser);
        fileForm.append("gUser", gUser);
        fileForm.append("hUser", hUser);
        if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/gif' || file.type == 'video/mp4' || file.type == 'video/webm' || file.type == 'video/ogg'){

            $.ajax({
                url: "/group/message",
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

    $(".voice-icon").click(() => {
        $(".messenge-send").fadeOut();
        $(".messenge-voice").fadeIn(1500);
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
    $(".audio-send").click(() => {
        $(".messenge-voice").css('display' , 'none');
        $(".messenge-send").fadeIn();
        $(".message-reply").html("");
        $("article").height("80vh");
        sendAudio();
        fetchMessage();
    });

    // for voice record
    let mediaRecorder;
    let audioChunks = [];

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
        formData.append("gpID", groupID);
        formData.append("userId", AuthID);
        formData.append("firstUser", firstUser);
        formData.append("secUser", secUser);
        formData.append("aUser", aUser);
        formData.append("bUser", bUser);
        formData.append("cUser", cUser);
        formData.append("dUser", dUser);
        formData.append("eUser", eUser);
        formData.append("fUser", fUser);
        formData.append("gUser", gUser);
        formData.append("hUser", hUser);

        $.ajax({
            url: "/group/message",
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
    $.ajax({
        url: `/group/ajax/${$("#groupID").val()}`,
        type: "GET",
        datatype: "json",
        contentType: false,
        processData: false,
        success: function (res) {

            $("article").html("");
            $.each(res.message, (key, m) => {
                const AuthID = $("#AuthID").val();
                const userImageDef = $("#userImageDef").attr("src");
                const userImage = $("#userImage").attr("src");
                const firUserImageDef = $("#firUserImageDef").attr("src");
                const firUserImage = $("#firUserImage").attr("src");
                const secUserImageDef = $("#secUserImageDef").attr("src");
                const secUserImage = $("#secUserImage").attr("src");
                const aUserImageDef = $("#aUserImageDef").attr("src");
                const aUserImage = $("#aUserImage").attr("src");
                const bUserImageDef = $("#bUserImageDef").attr("src");
                const bUserImage = $("#bUserImage").attr("src");
                const cUserImageDef = $("#cUserImageDef").attr("src");
                const cUserImage = $("#cUserImage").attr("src");
                const dUserImageDef = $("#dUserImageDef").attr("src");
                const dUserImage = $("#dUserImage").attr("src");
                const eUserImageDef = $("#eUserImageDef").attr("src");
                const eUserImage = $("#eUserImage").attr("src");
                const fUserImageDef = $("#fUserImageDef").attr("src");
                const fUserImage = $("#fUserImage").attr("src");
                const gUserImageDef = $("#gUserImageDef").attr("src");
                const gUserImage = $("#gUserImage").attr("src");
                const hUserImageDef = $("#hUserImageDef").attr("src");
                const hUserImage = $("#hUserImage").attr("src");
                const user = $("#user").val();
                const firstUser = $("#firstUser").val();
                const secUser = $("#secUser").val();
                const aUser = $("#aUser").val();
                const bUser = $("#bUser").val();
                const cUser = $("#cUser").val();
                const dUser = $("#dUser").val();
                const eUser = $("#eUser").val();
                const fUser = $("#fUser").val();
                const gUser = $("#gUser").val();
                const hUser = $("#hUser").val();
                const userName = $("#userName").val();
                const firstUserName = $("#firUserName").val();
                const secUserName = $("#secUserName").val();
                const aUserName = $("#aUserName").val();
                const bUserName = $("#bUserName").val();
                const cUserName = $("#cUserName").val();
                const dUserName = $("#dUserName").val();
                const eUserName = $("#eUserName").val();
                const fUserName = $("#fUserName").val();
                const gUserName = $("#gUserName").val();
                const hUserName = $("#hUserName").val();
                const currentUrl = "http://localhost:8000/";
                console.log(userImage);

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

                $("article").append(
                    `
                    ${
                        AuthID == m.user_id
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
                                            m.fir_status == "sent " &&
                                            m.sec_status == "sent" &&
                                            m.a_status == "sent" &&
                                            m.b_status == "sent" &&
                                            m.c_status == "sent" &&
                                            m.d_status == "sent" &&
                                            m.e_status == "sent" &&
                                            m.f_status == "sent" &&
                                            m.g_status == "sent" &&
                                            m.h_status == "sent"
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
                                                   m.sec_status == "sent" &&
                                                   m.a_status == "sent" &&
                                                   m.b_status == "sent" &&
                                                   m.c_status == "sent" &&
                                                   m.d_status == "sent" &&
                                                   m.e_status == "sent" &&
                                                   m.f_status == "sent" &&
                                                   m.g_status == "sent" &&
                                                   m.h_status == "sent"
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
                                                currentUrl +
                                                "storage/" +
                                                m.audio
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
                                    <div class="clickToReply py-3">
                                        <div class=" text-end">
                                        ${
                                            m.reply_chat_code != null
                                                ? ` <div class="mb-1 ${m.user_id == AuthID ? 'd-flex' : ''}">
                                                <div style="${m.user_id == AuthID ? 'margin-left:auto' : '' }">
                                                ${
                                                    m.user_id == AuthID
                                                        ? `
                                                        <small
                                                            class=" lightTextClass d-block mb-2 ${m.user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                            style="font-size: smaller">Replied to yourself</small>
                                                            `
                                                        : `
                                                        <small
                                                            class=" lightTextClass d-block mb-2 ${m.user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                            style="font-size: smaller">Replied to ${m.user_id == AuthID ? chatName : 'themselves' }</small>
                                                            `
                                                }
                                                <div class=" mb-1">
                                            ${m.reply_mes.length <= 40 ? `

                                                    <span
                                                        class=" opacity-25 rounded-3 border-0 lightTextClass ${m.user_id == AuthID ? 'text-end' : '' } px-4 py-2"
                                                        style="background-color: #e3f2fd;"><span
                                                            class=" ps-3"
                                                            style="border-left:2px solid black">
                                                        ${m.reply_mes}
                                                        </span>
                                                    </span>
                                                    `: `
                                                    <p
                                                        class=" opacity-25 rounded-3 border-0 offset-2 lightTextClass ${m.user_id == AuthID ? 'text-end' : '' } px-4 py-2"
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
                                                m.sec_status == "sent" &&
                                                m.a_status == "sent" &&
                                                m.b_status == "sent" &&
                                                m.c_status == "sent" &&
                                                m.d_status == "sent" &&
                                                m.e_status == "sent" &&
                                                m.f_status == "sent" &&
                                                m.g_status == "sent" &&
                                                m.h_status == "sent"
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
                                            `:`
                                            <p
                                                class=" rounded-bottom-3 rounded-start-3 offset-2 border-0 mt-4 lightTextClass text-end px-4 py-2"
                                                style="background-color: #e3f2fd"><span>${
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
                                                m.sec_status == "sent" &&
                                                m.a_status == "sent" &&
                                                m.b_status == "sent" &&
                                                m.c_status == "sent" &&
                                                m.d_status == "sent" &&
                                                m.e_status == "sent" &&
                                                m.f_status == "sent" &&
                                                m.g_status == "sent" &&
                                                m.h_status == "sent"
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
                                                        m.sec_status ==
                                                            "sent" ||
                                                        m.a_status == "sent" ||
                                                        m.b_status == "sent" ||
                                                        m.c_status == "sent" ||
                                                        m.d_status == "sent" ||
                                                        m.e_status == "sent" ||
                                                        m.f_status == "sent" ||
                                                        m.g_status == "sent" ||
                                                        m.h_status == "sent"
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
                                                             m.sec_status ==
                                                                 "sent" ||
                                                             m.a_status ==
                                                                 "sent" ||
                                                             m.b_status ==
                                                                 "sent" ||
                                                             m.c_status ==
                                                                 "sent" ||
                                                             m.d_status ==
                                                                 "sent" ||
                                                             m.e_status ==
                                                                 "sent" ||
                                                             m.f_status ==
                                                                 "sent" ||
                                                             m.g_status ==
                                                                 "sent" ||
                                                             m.h_status ==
                                                                 "sent"
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
                                                        m.sec_status ==
                                                            "sent" ||
                                                        m.a_status == "sent" ||
                                                        m.b_status == "sent" ||
                                                        m.c_status == "sent" ||
                                                        m.d_status == "sent" ||
                                                        m.e_status == "sent" ||
                                                        m.f_status == "sent" ||
                                                        m.g_status == "sent" ||
                                                        m.h_status == "sent"
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
                                                             m.sec_status ==
                                                                 "sent" ||
                                                             m.a_status ==
                                                                 "sent" ||
                                                             m.b_status ==
                                                                 "sent" ||
                                                             m.c_status ==
                                                                 "sent" ||
                                                             m.d_status ==
                                                                 "sent" ||
                                                             m.e_status ==
                                                                 "sent" ||
                                                             m.f_status ==
                                                                 "sent" ||
                                                             m.g_status ==
                                                                 "sent" ||
                                                             m.h_status ==
                                                                 "sent"
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
                    `: m.user_id != m.fir_user_id ||
                    m.user_id == m.fir_user_id ||
                   AuthID == m.fir_user_id ||
                   AuthID == m.sec_user_id ||
                   AuthID == m.a_user_id ||
                   AuthID == m.b_user_id ||
                   AuthID == m.c_user_id ||
                   AuthID == m.d_user_id ||
                   AuthID == m.e_user_id ||
                   AuthID == m.f_user_id ||
                   AuthID == m.g_user_id ||
                   AuthID == m.h_user_id ? `
                   <div class=" row">
                       <div class="my-2" style="width:60px">
                              ${(userImageDef != undefined || userImage != undefined) && m.user_id == user ? `
                                ${userImageDef != undefined ? `
                                    <img src="${userImageDef}"
                                        class="w-100 rounded-circle " alt="">
                                `: userImage != undefined ? `
                                    <img src="${userImage}"
                                        class="w-100 rounded-circle " alt="">
                                ` : ''}
                              `
                              : (firUserImageDef != undefined || firUserImage != undefined) && m.fir_user_id == firstUser ? `
                                ${firUserImageDef != undefined ? `
                                    <img src="${firUserImageDef}"
                                        class="w-100 rounded-circle " alt="">
                                `: firUserImage != undefined ? `
                                    <img src="${firUserImage}"
                                        class="w-100 rounded-circle " alt="">
                                ` : ''}
                                `
                                :(secUserImageDef != undefined || secUserImage != undefined) && m.sec_user_id == secUser ? `
                                    ${secUserImageDef != undefined ? `
                                        <img src="${secUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: secUserImage != undefined ? `
                                        <img src="${secUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                :(aUserImageDef != undefined || aUserImage != undefined) && m.a_user_id == aUser ? `
                                    ${aUserImageDef != undefined ? `
                                        <img src="${aUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: aUserImage != undefined ? `
                                        <img src="${aUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                    `
                                : (bUserImageDef != undefined || bUserImage != undefined) && m.b_user_id == bUser ? `
                                    ${bUserImageDef != undefined ? `
                                        <img src="${bUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: bUserImage != undefined ? `
                                        <img src="${bUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                : (cUserImageDef != undefined || cUserImage != undefined) && m.c_user_id == cUser ? `
                                    ${cUserImageDef != undefined ? `
                                        <img src="${cUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: cUserImage != undefined ? `
                                        <img src="${cUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                : (dUserImageDef != undefined || dUserImage != undefined) && m.d_user_id == dUser ? `
                                    ${dUserImageDef != undefined ? `
                                        <img src="${dUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: dUserImage != undefined ? `
                                        <img src="${dUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                : (eUserImageDef != undefined || eUserImage != undefined) && m.e_user_id == eUser ? `
                                    ${eUserImageDef != undefined ? `
                                        <img src="${eUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: eUserImage != undefined ? `
                                        <img src="${eUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                : (fUserImageDef != undefined || fUserImage != undefined) && m.f_user_id == fUser ? `
                                    ${fUserImageDef != undefined ? `
                                        <img src="${fUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: fUserImage != undefined ? `
                                        <img src="${fUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                : (gUserImageDef != undefined || gUserImage != undefined) && m.g_user_id == gUser ? `
                                    ${gUserImageDef != undefined ? `
                                        <img src="${gUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: gUserImage != undefined ? `
                                        <img src="${gUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
                                `
                                : (hUserImageDef != undefined || hUserImage != undefined) && m.h_user_id == hUser ? `
                                    ${hUserImageDef != undefined ? `
                                        <img src="${hUserImageDef}"
                                            class="w-100 rounded-circle " alt="">
                                    `: hUserImage != undefined ? `
                                        <img src="${hUserImage}"
                                            class="w-100 rounded-circle " alt="">
                                    ` : ''}
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
                               <div class=" clickToReply col pb-2">
                               ${ m.user_id == user ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${userName}
                                   </small>
                               ` : m.user_id == firstUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${firstUserName}
                                   </small>
                               ` : m.user_id == secUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${secUserName}
                                   </small>
                               ` : m.user_id == aUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${aUserName}
                                   </small>
                               ` : m.user_id == bUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${bUserName}
                                   </small>
                               ` : m.user_id == cUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${cUserName}
                                   </small>
                               ` : m.user_id == dUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${dUserName}
                                   </small>
                               ` :  m.user_id == eUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${eUserName}
                                   </small>
                               ` :  m.user_id == fUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${fUserName}
                                   </small>
                               ` :  m.user_id == gUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${gUserName}
                                   </small>
                               ` :  m.user_id == hUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${hUserName}
                                   </small> `:''}

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
                                       <small class=" lightTextClass ms-4"
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
                                <div class="clickToReply col pb-3">
                                ${ m.user_id == user ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${userName}
                                    </small>
                                ` : m.user_id == firstUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${firstUserName}
                                    </small>
                                ` : m.user_id == secUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${secUserName}
                                    </small>
                                ` : m.user_id == aUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${aUserName}
                                    </small>
                                ` : m.user_id == bUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${bUserName}
                                    </small>
                                ` : m.user_id == cUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${cUserName}
                                    </small>
                                ` : m.user_id == dUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${dUserName}
                                    </small>
                                ` :  m.user_id == eUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${eUserName}
                                    </small>
                                ` :  m.user_id == fUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${fUserName}
                                    </small>
                                ` :  m.user_id == gUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${gUserName}
                                    </small>
                                ` :  m.user_id == hUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${hUserName}
                                    </small> `:''}

                                    ${
                                        m.reply_chat_code != null
                                            ? ` <div class="mb-1 ${m.user_id == AuthID ? 'd-flex' : ''}">
                                            <div style="${m.user_id == AuthID ? 'margin-left:auto' : '' }">
                                            ${
                                                m.user_id == AuthID
                                                    ? `
                                                    <small
                                                        class=" lightTextClass d-block mb-2 ${m.user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                        style="font-size: smaller">Replied to yourself</small>
                                                        `
                                                    : `
                                                    <small
                                                        class=" lightTextClass d-block mb-2 ${m.user_id == AuthID ? 'text-end' : '' } opacity-50"
                                                        style="font-size: smaller">Replied to ${m.user_id == AuthID ? chatName : 'themselves' }</small>
                                                        `
                                            }
                                            <div class=" mb-1">
                                            ${m.reply_mes.length <= 40 ? `

                                                <span
                                                    class=" opacity-25 rounded-3 border-0 lightTextClass ${m.user_id == AuthID ? 'text-end' : '' } px-4 py-2"
                                                    style="background-color: #e3f2fd;"><span
                                                        class=" ps-3"
                                                        style="border-left:2px solid black">
                                                    ${m.reply_mes}
                                                    </span>
                                                </span>
                                                `: `
                                                <p
                                                class=" opacity-25 rounded-3 border-0 col-10 lightTextClass ${m.user_id == AuthID ? 'text-end' : '' } px-4 py-2"
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

                                    <div class=" pt-1">
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
                                        }" ></i></ai>
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
                                        <div class="clickToReply col pb-3">
                                        ${ m.user_id == user ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${userName}
                                            </small>
                                        ` : m.user_id == firstUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${firstUserName}
                                            </small>
                                        ` : m.user_id == secUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${secUserName}
                                            </small>
                                        ` : m.user_id == aUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${aUserName}
                                            </small>
                                        ` : m.user_id == bUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${bUserName}
                                            </small>
                                        ` : m.user_id == cUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${cUserName}
                                            </small>
                                        ` : m.user_id == dUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${dUserName}
                                            </small>
                                        ` :  m.user_id == eUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${eUserName}
                                            </small>
                                        ` :  m.user_id == fUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${fUserName}
                                            </small>
                                        ` :  m.user_id == gUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${gUserName}
                                            </small>
                                        ` :  m.user_id == hUser ? `
                                        <small
                                            class=" lightTextClass opacity-50"
                                            style="font-size: smaller">${hUserName}
                                            </small> `:''}



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
                                         ${ m.user_id == user ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${userName}
                                   </small>
                               ` : m.user_id == firstUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${firstUserName}
                                   </small>
                               ` : m.user_id == secUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${secUserName}
                                   </small>
                               ` : m.user_id == aUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${aUserName}
                                   </small>
                               ` : m.user_id == bUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${bUserName}
                                   </small>
                               ` : m.user_id == cUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${cUserName}
                                   </small>
                               ` : m.user_id == dUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${dUserName}
                                   </small>
                               ` :  m.user_id == eUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${eUserName}
                                   </small>
                               ` :  m.user_id == fUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${fUserName}
                                   </small>
                               ` :  m.user_id == gUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${gUserName}
                                   </small>
                               ` :  m.user_id == hUser ? `
                               <small
                                   class=" lightTextClass opacity-50"
                                   style="font-size: smaller">${hUserName}
                                   </small> `:''}

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
                                <div class=" clickToReply col pb-2">
                                ${ m.user_id == user ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${userName}
                                    </small>
                                ` : m.user_id == firstUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${firstUserName}
                                    </small>
                                ` : m.user_id == secUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${secUserName}
                                    </small>
                                ` : m.user_id == aUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${aUserName}
                                    </small>
                                ` : m.user_id == bUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${bUserName}
                                    </small>
                                ` : m.user_id == cUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${cUserName}
                                    </small>
                                ` : m.user_id == dUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${dUserName}
                                    </small>
                                ` :  m.user_id == eUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${eUserName}
                                    </small>
                                ` :  m.user_id == fUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${fUserName}
                                    </small>
                                ` :  m.user_id == gUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${gUserName}
                                    </small>
                                ` :  m.user_id == hUser ? `
                                <small
                                    class=" lightTextClass opacity-50"
                                    style="font-size: smaller">${hUserName}
                                    </small> `:''}


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
                                    <div class=" clickToReply col pb-2">
                                    ${ m.user_id == user ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${userName}
                                        </small>
                                    ` : m.user_id == firstUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${firstUserName}
                                        </small>
                                    ` : m.user_id == secUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${secUserName}
                                        </small>
                                    ` : m.user_id == aUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${aUserName}
                                        </small>
                                    ` : m.user_id == bUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${bUserName}
                                        </small>
                                    ` : m.user_id == cUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${cUserName}
                                        </small>
                                    ` : m.user_id == dUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${dUserName}
                                        </small>
                                    ` :  m.user_id == eUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${eUserName}
                                        </small>
                                    ` :  m.user_id == fUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${fUserName}
                                        </small>
                                    ` :  m.user_id == gUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${gUserName}
                                        </small>
                                    ` :  m.user_id == hUser ? `
                                    <small
                                        class=" lightTextClass opacity-50"
                                        style="font-size: smaller">${hUserName}
                                        </small> `:''}


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

                    :''
                } `
                );
            });
            $(".clickToReply").click(function () {
                $(this).find(".reply").fadeToggle();
                $(".reply").not($(this).find(".reply")).fadeOut();
            });

            $.each(res.message, (key, msg) => {
                $(`.fa-reply.${msg.chat_code}`).click(() => {
                    $("#sendMessageBtn").css("display", "none");
                    $("#sendMessageBtn1").css("display", "inline");
                    $("#sendFile").css("display", "none");
                    $("#sendFile1").css("display", "inline");

                    const token = $("#_token").val();
                    const groupID = $("#groupID").val();
                    const AuthID = $("#AuthID").val();
                    const user = $("#user").val();
                    const firstUser = $("#firstUser").val();
                    const secUser = $("#secUser").val();
                    const aUser = $("#aUser").val();
                    const bUser = $("#bUser").val();
                    const cUser = $("#cUser").val();
                    const dUser = $("#dUser").val();
                    const eUser = $("#eUser").val();
                    const fUser = $("#fUser").val();
                    const gUser = $("#gUser").val();
                    const hUser = $("#hUser").val();
                    const userName = $("#userName").val();
                    const firstUserName = $("#firUserName").val();
                    const secUserName = $("#secUserName").val();
                    const aUserName = $("#aUserName").val();
                    const bUserName = $("#bUserName").val();
                    const cUserName = $("#cUserName").val();
                    const dUserName = $("#dUserName").val();
                    const eUserName = $("#eUserName").val();
                    const fUserName = $("#fUserName").val();
                    const gUserName = $("#gUserName").val();
                    const hUserName = $("#hUserName").val();
                    const currentUrl = "http://localhost:8000/";

                    $.ajax({
                        url: `/group/message/reply/${msg.chat_code}`,
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
                                <input type="hidden" name="replyCode" id="replyText" value=${
                                    reply.text
                                }>

                                <div class=" px-4 py-2 rounded-top-3 lightTextClass"
                                style=" background-color: #eeeeee;">
                                ${
                                    reply.user_id == AuthID
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                    yourself</small>
                                `
                                        : reply.user_id == user
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${userName}</small>
                                     `
                                        : reply.user_id == firstUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${firstUserName}</small>
                                     `
                                        : reply.user_id == secUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${secUserName}</small>
                                    `
                                        : reply.user_id == aUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${aUserName}</small>
                                `
                                        : reply.user_id == bUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                    ${bUserName}</small>
                                `
                                        : reply.user_id == cUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${cUserName}</small>
                                `
                                        : reply.user_id == dUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${dUserName}</small>
                                `
                                        : reply.user_id == eUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${eUserName}</small>
                                `
                                        : reply.user_id == fUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${fUserName}</small>
                                `
                                        : reply.user_id == gUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${gUserName}</small>
                                `
                                        : reply.user_id == hUser
                                        ? `
                                    <small class=" col lightTextClass" style="font-size: smaller">Replying to
                                        ${hUserName}</small>
                                `
                                        : ""
                                }
                                <a><i
                                        class="fa-solid fa-xmark lightTextClass offset-9 col-1 ps-5 closeReply"></i></a>
                                <span class=" ps-3 d-block opacity-50"
                                    style=" border-left:2px solid #eeeeee;">
                                    ${reply.text}
                                </span>
                            </div>
                            </div>  `
                            );

                            $(".closeReply").click(() => {
                                $("#sendMessageBtn").css("display", "inline");
                                $("#sendMessageBtn1").css("display", "none");

                                $("#sendFile").css("display", "inline");
                                $("#sendFile1").css("display", "none");

                                $(".message-reply").html("");
                                $("article").height("80vh");
                            });

                            $("#sendMessageBtn1").one("click", (e) => {
                                e.preventDefault();
                                var messageInput = $(".messageInput").val();
                                var messageData = {
                                    gpID: groupID,
                                    userId: AuthID,
                                    firstUser: firstUser,
                                    secUser: secUser,
                                    aUser: aUser,
                                    bUser: bUser,
                                    cUser: cUser,
                                    dUser: dUser,
                                    eUser: eUser,
                                    fUser: fUser,
                                    gUser: gUser,
                                    hUser: hUser,
                                    replyCode: reply.chat_code,
                                    replyText: reply.text,
                                    message: messageInput,
                                };
                                $.ajax({
                                    url: "/group/message",
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
                        url: `/group/message/delete/${msg.chat_code}`,
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
                        url: `/group/message/delete/par/${msg.chat_code}`,
                        type: "GET",
                        datatype: "json",
                        success: function (res) {
                            console.log('successfully removed');
                            fetchMessage();
                        }
                    })
                })
            });
        },
    });
}

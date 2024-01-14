Notification.requestPermission();

// audio recorder
var recorder, audio_stream, chunks;
// set preview
// const preview = document.getElementById("audio-playback");
var word_list, current_word;

function flyToElement(flyer, flyingTo) {
  var $func = $(this);
  var divider = 3;
  var flyerClone = $(flyer).clone();
  $(flyerClone).css({
    position: "absolute",
    top: $(flyer).offset.top + "px",
    left: $(flyer).offset.left + "px",
    opacity: 1,
    "z-index": 1000,
  });
  $("body").append($(flyerClone));
  var gotoX =
    $(flyingTo).offset().left +
    $(flyingTo).width() / 2 -
    $(flyer).width() / divider / 2;
  var gotoY =
    $(flyingTo).offset().top +
    $(flyingTo).height() / 2 -
    $(flyer).height() / divider / 2;

  $(flyerClone).animate(
    {
      opacity: 0.4,
      left: gotoX,
      top: gotoY,
      width: $(flyer).width() / divider,
      height: $(flyer).height() / divider,
    },
    700,
    function () {
      $(flyingTo).fadeOut("fast", function () {
        $(flyingTo).fadeIn("fast", function () {
          $(flyerClone).fadeOut("fast", function () {
            $(flyerClone).remove();
          });
        });
      });
    }
  );
}

function startRecording() {
  navigator.mediaDevices
    .getUserMedia({ audio: true })
    .then(function (stream) {
      audio_stream = stream;
      recorder = new MediaRecorder(stream);

      // when there is data, compile into object for preview src
      recorder.ondataavailable = function (e) {
        const preview = document.getElementById("audio-playback");
        var url = URL.createObjectURL(e.data);
        preview.src = url;
        chunks.push(e.data);
        var blob = new Blob(chunks, { type: "audio/wav" });
        console.log(blob.text());
        postRecordingAI(blob);
        // postRecordingAI_custom(blob);

        // download audio file
        // var downloadAudio = document.getElementById("download-audio");

        // set link href as blob url, replaced instantly if re-recorded
        // downloadAudio.href = url;
      };

      chunks = [];
      recorder.start();

      timeout_status = setTimeout(function () {
        console.log("5 min timeout");
        stopRecording();
      }, 300000);
    })
    .catch(function (error) {
      console.error("Error accessing audio stream: ", error);
    });
}

function stopRecording() {
  if (recorder && audio_stream) {
    recorder.stop();
    audio_stream.getAudioTracks()[0].stop();
  }
}

// This function is to post recording to AI in order to get result and score for the recording audio file from 
function postRecordingAI(blob) {
  console.log('postRecordingAI');

  // url:
  //   "https://lxp.vus.edu.vn/ords/connect/mis/Activity_Item_Content_Submission_Blob?ITEM_ID=1&CONTENT_ID=" +
  //   apex.item("P554_WORD_IDX").getValue() +
  //   "&PERSON_ID=" +
  //   parseInt(apex.item("P554_PERSON_ID").getValue()) +
  //   "&PERSON_TYPE='ST'&TEXT_CONTENT=" +
  //   apex.item("P554_WORD_TEXT").getValue(),
  // method: "POST",
  // timeout: 0,
  // headers: {
  //   Authorization: "Basic Y29ubmVjdF91c2VyOiNQQHNzd29yZCMyMDIy",
  //   "Content-Type": "audio/wav",
  // },
  // processData: false,
  // contentType: false,
  // data: blob,

  // ---------------------
  // end point: https://api2.speechace.com/api/scoring/text/v9/json?key=%2Fca9SiIJBgN0Fp%2FpyYGBEQuqS%2BWKTQ9Bc%2FZPQ4SQADdCXL8PS0i7QsV06D5qYcX1djIC5IQWBlK9sHu1TgG7bT%2BPmV0cXoFjko53Fh%2F%2FjHAWLVFcmgkhn8U%2BJekkMohO&dialect=en-gb
  // Content-Type: multipart/form-data; boundary=<calculated when request is sent>

  // [BODY]:
  // *text
  // apple

  // A word, phrase, or sentence to score.

  // *user_audio_file
  // file with user audio (wav, mp3, m4a, webm, ogg, aiff)

  // *question_info
  // 'u1/q1'

  // A unique identifier for the activity or question this user audio is answering.

  // *no_mc
  // 1    
  // Optional flag to indicate the text field contains multiple lines.
  let ajaxurl = '/wp-admin/admin-ajax.php';

  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "speechace_audio_to_score",
      requestData: 
      {
        text: 'apple',
        // user_audio_file: blob,
        question_info: 'u1/q1',
        no_mc: '1'
      }
    },
    success: function (response) {
      console.log(response);
    },
    error: function (error) {
      console.error(error);
    }
  });

}

function postRecordingAI_custom(blob) {
  console.log('postRecordingAI');

  // Create a FormData instance
  var formData = new FormData();

  // Append the necessary fields
  formData.append('text', 'apple'); // Replace 'apple' with the actual text to score
  formData.append('user_audio_file', blob);
  formData.append('question_info', 'u1/q1'); // Replace 'u1/q1' with the actual unique identifier
  formData.append('no_mc', '1'); // Replace '1' with the actual flag value

  // Define the fetch options
  var options = {
    method: 'POST',
    body: formData
  };

  // Make the request
  // fetch('https://api2.speechace.com/api/scoring/text/v9/json?key=%2Fca9SiIJBgN0Fp%2FpyYGBEQuqS%2BWKTQ9Bc%2FZPQ4SQADdCXL8PS0i7QsV06D5qYcX1djIC5IQWBlK9sHu1TgG7bT%2BPmV0cXoFjko53Fh%2F%2FjHAWLVFcmgkhn8U%2BJekkMohO&dialect=en-gb', options)
  //   .then(response => response.json())
  //   .then(data => console.log(data))
  //   .catch(error => console.error('Error:', error));

  // fetch from api-proxy
  fetch('/api-proxy', options)
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));

}



function downloadRecording() {
  var name = new Date();
  var res = name.toISOString().slice(0, 10);
  downloadAudio.download = res + ".wav";
}

// Load Content
function load_content(item_id, program_id, session_id) {
  apex.server.process(
    "Get_Item_Content_Mobile",
    {
      x01: item_id,
      x02: program_id,
      x03: session_id,
    }, // Parameter to be passed to the server
    {
      success: function (pData) {
        // Success
        console.log(pData);
        word_list = pData;
        // if(pData.status =='success')
        // {

        // }
      },
      error: function (e) {
        console.log("Error: ", e);
      },
      dataType: "json", // Response type
    }
  );
}

var isSpeaking = false;
function speak() {
  if (isSpeaking) {
    return;
  }
  isSpeaking = true;
  $("#speak-img").prop("disabled", true);
  $(".___btn_counter").show();
  apex.item("P554_RECORDED").setValue("No");
  $(".___counter").html(3);
  var audio = new Audio(
    "https://hcm01.vstorage.vngcloud.vn/v1/AUTH_77c1e15122904b63990a9da99711590d/public_resources/SK/Audio%20Effects/Countdown.wav"
  );
  audio.play();
  var counter = 3;
  apex.item("P554_COUNTER").setValue(counter);
  var interval = setInterval(function () {
    counter--;
    $(".___counter").html(counter);
    apex.item("P554_COUNTER").setValue(counter);
    // Display 'counter' wherever you want to display it.
    if (counter == 0) {
      // Display a login box
      clearInterval(interval);
      $(".___btn_recording").show();
      $(".___btn_counter").hide();
      startRecording();
      isSpeaking = false;
    }
  }, 1000);
}

function recording() {
  console.log("thanks for your submission");
  $(".___btn_recording").hide();
  $(".___btn_counter").hide();
  apex.item("P554_RECORDED").setValue("Yes");
  stopRecording();
}

//test introjs
function testIntro() {
  var items;
  var items_final = [];

  apex.server.process(
    "Get_Item_Onboarding_Mobile",
    {
      //x01: element_id,
      x01: "554",
    }, // Parameter to be passed to the server
    {
      success: function (pData) {
        // Success
        console.log(pData);
        items = pData.introjs;
        $.each(items, function (index, value) {
          var obj = {
            element: document.querySelector(value.ELEMENT),
            title: value.TITLE,
            intro: value.INTRO,
            position: value.POSITION,
          };
          if (value.DISPLAY == 1) {
            items_final.push(obj);
          }
        });

        introJs()
          .setOptions({
            disableInteraction: true,
            steps: items_final,
          })
          .start();
      },
      error: function (e) {
        console.log("Error: ", e);
      },
      dataType: "json", // Response type
    }
  );
  console.log(items_final);
}

$(".t-ContentBlock-title").html("");

$(".___click_box_slice").click(function () {
  $("#perfectAnswer").css({ display: "none" });
  var idx = parseInt(apex.item("P554_WORD_IDX").getValue());
  $(".___click_box").effect("shake", { times: 4 }, 1000);
  $(".___fox_box").html(
    '<img src="https://hcm01.vstorage.vngcloud.vn/v1/AUTH_77c1e15122904b63990a9da99711590d/LXP_Media/theme/activities/img/speakAI/fox-start.svg" alt="">'
  );
  flyToElement($(this), $("#boxContent"));

  $("#boxContent").css(
    "background-image",
    "url('https://hcm01.vstorage.vngcloud.vn/v1/AUTH_77c1e15122904b63990a9da99711590d/LXP_Media/theme/activities/img/speakAI/center-box.svg')"
  );
  var word = word_list.words[idx];
  current_word = word;
  $(".___box_text").html(
    '<span class="text_inner_box">' + word.VOCAB + "</span>"
  );
  apex.item("P554_WORD_TEXT").setValue(word.VOCAB);
  apex.item("P554_WORD_AUDIO").setValue(word.VOCAB_AUDIO);
  idx = idx + 1;
  apex.item("P554_WORD_IDX").setValue(idx);

  $(this).remove();
});

//   $('.listen').click(function() {
//       var audio = new Audio(apex.item('P554_WORD_AUDIO').getValue());
//       audio.play();
//   });
$(".listenagain").click(function () {
  var audio = $("#audio-playback");
  audio[0].play();
});
var isAudioPlaying = false;

$(".listen").click(function () {
  if (isAudioPlaying) {
    return;
  }

  var audioSrc = apex.item("P554_WORD_AUDIO").getValue();
  if (audioSrc && audioSrc !== "0") {
    var audio = new Audio(audioSrc);

    audio.onended = function () {
      isAudioPlaying = false;
    };
    isAudioPlaying = true;
    audio.play();
  }
});

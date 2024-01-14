<!DOCTYPE html>
<html>
<head>
    <title>Audio Recording</title>
    <!-- Add any additional head elements here -->
</head>
<body>
    <!-- Start Recording Button -->
    <button id="startRecordingBtn">Start Recording</button>

    <!-- Stop Recording Button -->
    <button id="stopRecordingBtn" style="display:none;">Stop Recording</button>

    <!-- Audio Playback Element -->
    <!-- <audio id="audioPlayback" controls style="display:none;"></audio> -->
    <audio id="audio-playback" controls style="display:none;"></audio>

    <!-- Status Message -->
    <div id="statusMessage"></div>

    <!-- download button -->
    <!-- <a id="downloadLink" style="display:none;">Download</a> -->

    <!-- download audio -->
    <a id="download-audio">Download</a>

    <!-- Additional elements as needed -->
    <!-- ... -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Your JavaScript File -->
    <script src="speakai.js"></script>


    <br>


    <script>
        // JavaScript to toggle button visibility and other interactive elements
        document.getElementById('startRecordingBtn').addEventListener('click', function() {
            startRecording();
            this.style.display = 'none';
            document.getElementById('stopRecordingBtn').style.display = 'inline-block';
        });

        document.getElementById('stopRecordingBtn').addEventListener('click', function() {
            stopRecording();
            this.style.display = 'none';
            document.getElementById('audio-playback').style.display = 'inline-block';
        });
    </script>
</body>
</html>

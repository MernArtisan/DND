<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ZegoCloud Stream Player</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding-top: 50px;
    }
    #localVideo {
      width: 640px;
      height: 360px;
      background: #000;
      margin: auto;
      border: 2px solid #ccc;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <h2>ZegoCloud Live Stream Viewer</h2>
  <div id="localVideo"></div>

  <!-- Zego Web SDK -->
  <script src="https://cdn.zegocloud.com/zygocloud/zego-express-video/zego-express-video-web.min.js"></script>

  <script>
    const appID = 108591398;
    const appSign = "40b09ddebbab597fd642f4afcc62d94f29e6235b39a3ab86e18db07fa7ab7145";
    const userID = "web_" + Math.floor(Math.random() * 10000);
    const userName = "WebViewer";

    const streamID = "flutter_stream_1";  // 🔁 Change this to actual streamID from Flutter
    const roomID = "test_room";           // 🔁 Change this to the same room Flutter is using

    const zg = new ZegoExpressEngine(appID, appSign);

    (async () => {
      try {
        await zg.loginRoom(roomID, {
          userID,
          userName
        }, {
          userUpdate: true
        });

        const remoteStream = await zg.startPlayingStream(streamID);

        const videoElement = document.createElement("video");
        videoElement.autoplay = true;
        videoElement.playsInline = true;
        videoElement.controls = true;
        videoElement.srcObject = remoteStream;

        document.getElementById("localVideo").appendChild(videoElement);
      } catch (err) {
        console.error("Error while playing stream:", err);
        alert("Stream play failed: " + err.message);
      }
    })();
  </script>

</body>
</html>

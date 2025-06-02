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

  <!-- ✅ Zego Web SDK: Correct CDN -->
  <script src="https://zegocloud.github.io/zego-express-web-sdk/index.js"></script>

  <script>
    const appID = 108591398;
    const appSign = "40b09ddebbab597fd642f4afcc62d94f29e6235b39a3ab86e18db07fa7ab7145";
    const userID = "web_" + Math.floor(Math.random() * 10000);
    const userName = "WebViewer";

    const streamID = "stream_001";  // 🔁 Replace with actual stream ID
    const roomID = "test_room";     // 🔁 Replace with room ID used in Flutter

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
        console.error("Stream play failed:", err);
        alert("Stream play failed: " + err.message);
      }
    })();
  </script>

</body>
</html>

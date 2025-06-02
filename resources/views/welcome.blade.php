<!-- public/stream.html -->
<!DOCTYPE html>
<html>
<head>
  <title>ZegoCloud Stream</title>
  <script src="https://js.zegocloud.com/sdk/latest/zego-express-video.min.js"></script>
</head>
<body>
  <div id="video-container" style="width: 600px; height: 400px;"></div>

  <script>
    async function startZegoStream() {
      const res = await fetch('/api/stream-info');
      const data = await res.json();

      const zg = new ZegoExpressEngine(data.appID, data.appSign);

      await zg.loginRoom(data.roomID, 1, {
        userID: data.userID,
        userName: data.userName
      });

      const localStream = await zg.createStream();
      const remoteContainer = document.getElementById('video-container');
      zg.startPublishingStream('stream_001', localStream);
      zg.startPlayingStream('stream_001', {
        container: remoteContainer
      });
    }

    startZegoStream();
  </script>
</body>
</html>

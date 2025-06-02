<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ZegoCloud Web Viewer</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 40px; }
        #remoteVideo { width: 720px; height: 405px; background: #000; margin: auto; border-radius: 10px; }
    </style>
</head>
<body>

<h2>ZegoCloud Live Stream Viewer</h2>
<div id="remoteVideo"></div>

<!-- ✅ Working Zego Web SDK -->
<script src="https://cdn.jsdelivr.net/npm/zego-express-engine-webrtc@latest/index.js"></script>

<script>
    const appID = 108591398;
    const appSign = "40b09ddebbab597fd642f4afcc62d94f29e6235b39a3ab86e18db07fa7ab7145";
    const userID = "web_" + Math.floor(Math.random() * 10000);
    const userName = "LaravelViewer";

    const streamID = "stream_001";     // Flutter se same hona chahiye
    const roomID = "test_room";        // Flutter se same hona chahiye

    const zg = new ZegoExpressEngine(appID, appSign);

    (async () => {
        try {
            await zg.loginRoom(roomID, { userID, userName }, { userUpdate: true });

            const remoteStream = await zg.startPlayingStream(streamID);

            const videoElement = document.createElement("video");
            videoElement.autoplay = true;
            videoElement.playsInline = true;
            videoElement.controls = true;
            videoElement.srcObject = remoteStream;

            document.getElementById("remoteVideo").appendChild(videoElement);
        } catch (error) {
            console.error("Stream failed:", error);
            alert("Unable to play stream: " + error.message);
        }
    })();
</script>

</body>
</html>

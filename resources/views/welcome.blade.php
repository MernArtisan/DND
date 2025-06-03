<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zego Live Viewer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Local Zego SDK -->
    <script src="{{ asset('zego-uikit-prebuilt.js') }}"></script>
</head>
<body style="margin: 0; padding: 0;">
    <div id="zego-container" style="width: 100vw; height: 100vh;"></div>

    <script>
        window.onload = function () {
            const appID = 1269365093; // ✅ replace with your real appID
            const liveID = "Live-001"; // ✅ must match host liveID
            const userID = "viewer_" + Math.floor(Math.random() * 10000);
            const token = `04AAAAAGg/rtwADBwIg/YLzFMTzxc0UwCt0NfiEVhPecTUqrU2HfqMmLjeOMayMp+IohBnLlSk3gQG613kuGr7rd432EI/25lRmDb52YsYEL1VBYXid+ns97WycrI27J/FFmhONiMbwOZCne1xcA4Tc6cLy7b2TZWYBx3p0GAv577QPmRKcEVTznAKbRMp4TLpd5REdZQmTUI4H/o8nOFDQmjFd11wR1WuzH/fCxZXTeQBAdM3wOT29qODiOmQojvJhjc9R6MB`;

            const kit = window.ZegoUIKitPrebuilt.create({
                appID: appID,
                roomID: liveID,
                userID: userID,
                userName: userID,
                token: token,
                container: document.getElementById("zego-container"),
                scenario: {
                    mode: window.ZegoUIKitPrebuilt.LiveStreaming,
                    config: {
                        role: "Audience"
                    }
                }
            });

            // Show UI (auto-joins audience view)
            kit.joinRoom();
        };
    </script>
</body>
</html>

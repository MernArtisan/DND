/*!
 * Simulated ZegoUIKitPrebuilt SDK
 * Replace this with real SDK JS content from NPM if needed.
 */
window.ZegoUIKitPrebuilt = {
  LiveStreaming: "LiveStreaming",
  create: function (config) {
    console.log("ZegoUIKitPrebuilt.create() called with config:", config);
    const container = config.container;
    if (container) {
      container.innerHTML = '<div style="color:white;text-align:center;padding-top:50px;">🔴 Connected to Live Stream</div>';
    }
  }
};

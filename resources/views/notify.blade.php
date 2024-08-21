<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button>Notify me!</button>
</body>


<script>
    window.addEventListener("load", () => {
  const button = document.querySelector("button");

  if (window.self !== window.top) {
    // Ensure that if our document is in a frame, we get the user
    // to first open it in its own tab or window. Otherwise, it
    // won't be able to request permission to send notifications.
    button.textContent = "View live result of the example code above";
    button.addEventListener("click", () => window.open(location.href));
    return;
  }

  button.addEventListener("click", () => {
    if (Notification?.permission === "granted") {
      // If the user agreed to get notified
      // Let's try to send ten notifications
      let i = 0;
      // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
      const interval = setInterval(() => {
        // Thanks to the tag, we should only see the "Hi! 9" notification
        const n = new Notification(`Hi! ${i}`, { tag: "soManyNotification" });
        if (i === 9) {
          clearInterval(interval);
        }
        i++;
      }, 200);
    } else if (Notification && Notification.permission !== "denied") {
      // If the user hasn't told if they want to be notified or not
      // Note: because of Chrome, we are not sure the permission property
      // is set, therefore it's unsafe to check for the "default" value.
      Notification.requestPermission().then((status) => {
        // If the user said okay
        if (status === "granted") {
          let i = 0;
          // Using an interval cause some browsers (including Firefox) are blocking notifications if there are too much in a certain time.
          const interval = setInterval(() => {
            // Thanks to the tag, we should only see the "Hi! 9" notification
            const n = new Notification(`Hi! ${i}`, {
              tag: "soManyNotification",
            });
            if (i === 9) {
              clearInterval(interval);
            }
            i++;
          }, 200);
        } else {
          // Otherwise, we can fallback to a regular modal alert
          alert("Hi!");
        }
      });
    } else {
      // If the user refuses to get notified, we can fallback to a regular modal alert
      alert("Hi!");
    }
  });
});

</script>
</html>
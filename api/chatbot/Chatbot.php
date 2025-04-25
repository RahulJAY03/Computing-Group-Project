
<script>
(function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="6tni5jqRsJ44pgx9uIDMh";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
</script>
<script>
console.log("Loading Chatbase...");
console.log("Chatbase Email: <?php echo $userEmail; ?>");
console.log("Chatbase HMAC: <?php echo $hmac; ?>");

(function(){
  if (!window.chatbase || window.chatbase("getState") !== "initialized") {
    window.chatbase = (...arguments) => {
      if (!window.chatbase.q) window.chatbase.q = [];
      window.chatbase.q.push(arguments);
    };
    window.chatbase = new Proxy(window.chatbase, {
      get(target, prop) {
        if (prop === "q") return target.q;
        return (...args) => target(prop, ...args);
      }
    });
  }

  const onLoad = function() {
    const script = document.createElement("script");
    script.src = "https://www.chatbase.co/embed.min.js";
    script.id = "6tni5jqRsJ44pgx9uIDMh"; // Use your actual Chatbase agent ID here
    script.setAttribute("chatbase-user-id", "<?php echo $userEmail; ?>");
    script.setAttribute("chatbase-user-hmac", "<?php echo $hmac; ?>");
    script.domain = "www.chatbase.co";
    document.body.appendChild(script);
  };

  if (document.readyState === "complete") {
    onLoad();
  } else {
    window.addEventListener("load", onLoad);
  }
})();
</script>
<?php
// session_start();

// Get the email from the session (make sure it's set during login)
$userEmail = $_SESSION['email'] ?? 'guest@example.com'; // fallback if not logged in

// Your secret key from Chatbase dashboard
// Replace this with your actual secret key

// Generate the HMAC hash
$hmac = hash_hmac('sha256', $userEmail, $secret);
?>
// Set timeout variables.
var warningTimer;
var timeoutTimer;

// Start warning timer.
function startAutoLogoutTimer() {

    warningTimer = setTimeout("autoLogoutIdleWarning()", 600000);
    
}


function sessionTimers() {
  //  document.addEventListener("mousemove", resetAutoLogoutTimer, false);
      document.addEventListener("mousedown", resetAutoLogoutTimer, false);
  //  document.addEventListener("keypress", resetAutoLogoutTimer, false);
  //  document.addEventListener("touchmove", resetAutoLogoutTimer, false);
  //  document.addEventListener("onscroll", resetAutoLogoutTimer, false); 
}



// Reset timers.
function resetAutoLogoutTimer() {
    window.location = '#';
    clearTimeout(timeoutTimer);
    startAutoLogoutTimer();
    $("#autologoutModal").modal("hide");
}

// Show idle timeout warning dialog.
function autoLogoutIdleWarning() {
    clearTimeout(warningTimer);
    timeoutTimer = setTimeout("AutoLogoutIdleTimeout()", 10000);
    $("#autologoutModal").modal("show");
}

// Logout the user.
function AutoLogoutIdleTimeout() {
    window.location.href = baseUrl + 'home/dologout';
}
<div class="modal fade bs-example-modal-lg" id="autologoutModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Session Expiration</h4>
            </div>
            <div class="modal-body">
                    <p>You will be logged out in ten seconds. Click "Stay Logged In" to prevent this.</p>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-sm btn-round btn-default" name="autologoutStayLoggedIn" id="autologoutStayLoggedIn" value="Stay Logged In" class="admin-button" onclick="resetAutoLogoutTimer();" />
            </div>

        </div>
    </div>
</div>

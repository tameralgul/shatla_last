
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close d-flex align-items-center justify-content-center"
                    data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="ion-ios-close"></span>
                </button>
            </div>
            <div class="modal-body p-4 p-md-5" style="color: #f1cb4e; border-color: #f1cb4e">
                <div class="icon d-flex align-items-center justify-content-center">
                    <span class="ion-ios-person"></span>
                </div>
                <h4 class="text-center mb-4">تسجيل الدخول</h4>
                <form class="login-form" id="loginform">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="email" class="form-control rounded-left" placeholder="الايميل">
                    </div>
                    <small id="email_error" class="form-text text-danger text-right"></small>
                    <div class="form-group d-flex">
                        <input type="password" name="password" class="form-control rounded-left"
                            placeholder="كلمة السر">
                    </div>
                    <small id="password_error" class="form-text text-danger text-right"></small>
                    <div class="form-group">
                        <button type="button" id="saveBtn" class="col-sm-12 btn btn-checkout ">تسجيل الدخول</button>
                    </div>
                    <div class="form-group d-md-flex">

                        <div class="w-50 text-md-right">
                            <a href="/forget-password/">هل نسيت كلمة المرور؟</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p>ليس لديك حساب؟ <a href="{{ route('user.register') }}" class="font-weight-bold">انشيء حسابك الآن</a></p>
            </div>
                </div>
    </div>
</div>


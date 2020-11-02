<div class="js-cookie-consent cookie-consent bg-primary fixed-bottom text-center">

    <span class="cookie-consent__message">
        {{ __('This website uses cookies to improve your experience.') }}
    </span>

    <button class="btn btn-sm btn-success consent-button js-cookie-consent-agree cookie-consent__agree">
        <b>{{ __('Accept') }}</b>
    </button>

</div>

<style>
    .fixed-bottom {
        z-index: 1;
        position: fixed;
        bottom: 5px;
        width: 100%;
    }
    .consent-button{
        border-radius: 10px;
        padding-left: 20px;
        padding-right: 20px;
        margin-bottom: 3px;
        margin-top: 3px;
    }
</style>

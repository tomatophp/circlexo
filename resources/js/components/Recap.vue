<template>
    <div>
        <vue-recaptcha v-show="showRecaptcha" :sitekey="siteKey"
                       size="normal"
                       @verify="recaptchaVerified"
                       @expire="recaptchaExpired"
                       @fail="recaptchaFailed"
                       ref="vueRecaptcha">
        </vue-recaptcha>
    </div>
</template>

<script>
import vueRecaptcha from 'vue3-recaptcha2';

export default {
    components: {
        vueRecaptcha
    },

    props: {
        siteKey: {
            type: String,
            required: true,
        },
        modelValue: {
            type: String
        },
        hasError: {
            type: Boolean,
        }
    },

    data() {
        return {
            value: "",
            showRecaptcha: true
        }
    },

    methods: {
        verifyCallback() {
        },
        recaptchaVerified(response) {
            this.value = response;
        },
        recaptchaExpired() {
            this.$refs.vueRecaptcha.reset();
        },
        recaptchaFailed() {
        }
    },
    watch: {
        value: function (val) {
            if (val) {
                this.$emit('update:modelValue', val)
            }
        },
        hasError: function () {
            this.$refs.vueRecaptcha.reset();
        }
    },
}
</script>

<template>
    <div class="container py-5 border-top border-2 mt-5">
        <form ref="form"
              method="POST"
              class="px-5"
              @submit.prevent="onSubmit"
        >
            <h2>Bitcoin limiter</h2>
            <p class="fs-6">Please fill the form if you want receive email notification when Bitcoin price exceeds some amount!</p>
            <div class="mb-3">
                <input type="email"
                       v-model="form.email"
                       class="form-control"
                       placeholder="Your Email"
                       :disabled="alreadySubmitted"
                >
            </div>
            <div class="mb-3">
                <input type="number"
                       v-model="form.amount_threshold"
                       class="form-control"
                       step="0.01"
                       placeholder="Bitcoin amount"
                       :disabled="alreadySubmitted"
                >
            </div>
            <p v-if="hasErrors" class="fs-6 text-danger" >Please fill all inputs!</p>
            <button v-if="!alreadySubmitted" type="submit" class="btn btn-primary">Submit</button>

            <p v-if="alreadySubmitted" class="fs-6 text-success">
                Your subscription was added successfully!
            </p>

        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                alreadySubmitted: false,
                form: {
                    email: '',
                    amount_threshold: null,
                },
                hasErrors: false,
            }
        },
        mounted() {
        },
        methods: {
            onSubmit: function() {

                const vm = this
                vm.hasErrors = false

                if(!vm.form.amount_threshold || !vm.form.email) {
                    vm.hasErrors = true
                    return false
                }

                axios.post(
                    'api/bitcoin-subscribers',
                    {
                        _method: 'POST',
                        _csrf: window['document'].querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        ...this.form
                    }
                )
                .then((response) => {
                    if(response.data.success) {
                        vm.alreadySubmitted = true
                    }
                })
            }
        }
    }
</script>

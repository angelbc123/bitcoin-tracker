<template>
  <div class="container py-5 border-top border-2 mt-5">
    <form ref="form"
          method="POST"
          class="px-5"
          @submit.prevent="onSubmit"
    >
      <h2>Bitcoin Subscriber</h2>
      <p class="fs-6">
        Please fill the form if you want receive email notification when Bitcoin price exceeds threshold amount!
      </p>
      <div class="mb-3">
        <input type="email"
               v-model="form.email"
               class="form-control"
               placeholder="Your Email"
               :disabled="alreadySubmitted"
               required
        >
      </div>
      <div class="mb-3">
        <input type="number"
               v-model="form.amount_threshold"
               class="form-control"
               step="0.01"
               placeholder="Threshold amount"
               :disabled="alreadySubmitted"
               required
        >
      </div>
      <button v-if="!alreadySubmitted" type="submit" class="btn btn-primary">Subscribe</button>

      <p v-if="alreadySubmitted" class="fs-6 text-success">
        Your subscription was added successfully!
      </p>

      <p v-if="responseError" class="fs-6 text-danger">
        Something went wrong. Please try again!
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
      responseError: false
    }
  },
  mounted() {
  },
  methods: {
    onSubmit: function () {

      const vm = this

      axios.post(
        'api/bitcoin-subscribers',
        {
          _method: 'POST',
          _csrf: window['document'].querySelector('meta[name="csrf-token"]').getAttribute('content'),
          ...this.form
        }
      )
        .then((response) => {
          if (response.data.success) {
            vm.alreadySubmitted = true
          }
        })
        .catch(err => {
          vm.responseError = true
        })

    }
  }
}
</script>

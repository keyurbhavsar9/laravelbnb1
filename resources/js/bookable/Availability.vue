<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">
            Check availability
            <span v-if="noAvailability" class="text-danger"
                >(NOT AVILABLE)</span
            >
            <span v-if="hasAvailability" class="text-success">(AVILABLE)</span>
        </h6>

        <div class="form-row">
            <div class="form-btn-group col-md-6">
                <label for="from">From</label>
                <input
                    type="text"
                    name="from"
                    class="form-control form-control-sm"
                    placeholder="Start date"
                    v-model="from"
                    @keyup.enter="check"
                    :class="[{ 'is-invalid': this.errorFor('from') }]"
                />
                <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorFor('from')"
                    :key="'from' + index"
                >
                    {{ error }}
                </div>
            </div>

            <div class="form-btn-group col-md-6">
                <label for="to">To</label>
                <input
                    type="text"
                    name="to"
                    class="form-control form-control-sm"
                    placeholder="End date"
                    v-model="to"
                    @keyup.enter="check"
                    :class="[{ 'is-invalid': this.errorFor('to') }]"
                />
                <div
                    class="invalid-feedback"
                    v-for="(error, index) in this.errorFor('to')"
                    :key="'to' + index"
                >
                    {{ error }}
                </div>
            </div>
        </div>
        <button
            class="btn btn-secondary mt-5 btn-block"
            @click="check"
            :disabled="loading"
        >
            Check!
        </button>
    </div>
</template>

<style scoped>
label {
    font-size: 0.7rem;
    text-transform: uppercase;
    color: grey;
    font-weight: bolder;
}

.is-invalid {
    border-color: brown;
    background-image: none;
}
.invalid-feedback {
    border-color: brown;
}
</style>

<script>
export default {
    props: {
        bookableId: String
    },
    data() {
        return {
            from: null,
            to: null,
            loading: false,
            status: null,
            errors: null
        };
    },
    methods: {
        check() {
            this.loading = true;
            this.errors = null;
            axios
                .get(
                    `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
                )
                .then(response => {
                    this.status = response.status;
                })
                .catch(error => {
                    if (422 === error.response.status) {
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                })
                .then(() => (this.loading = false));
        },

        errorFor(field) {
            return this.hasErrors && this.errors[field]
                ? this.errors[field]
                : null;
        }
    },
    computed: {
        hasErrors() {
            return 422 === this.status && this.errors != null;
        },
        hasAvailability() {
            return 200 === this.status;
        },
        noAvailability() {
            return 404 === this.status;
        }
    }
};
</script>

<template>
    <div class="row">
        <div class="col-md-8 pb-4">
            <div class="card">
                <div class="card-body">
                    <div v-if="!loading">
                        <h2>{{ bookable.title }}</h2>
                        <hr />
                        <article>{{ bookable.description }}</article>
                    </div>

                    <div v-else>Loading...</div>
                </div>
            </div>

            <reviewList :bookable-id="this.$route.params.id"></reviewList>
        </div>

        <div class="col-md-4 pb-4">
            <availability :bookable-id="this.$route.params.id"> </availability>
        </div>
    </div>
</template>

<script>
import availability from "./Availability";
import reviewList from "./ReviewList";
console.log(availability);
export default {
    components: {
        availability,
        reviewList
    },
    data() {
        return {
            bookable: null,
            loading: false
        };
    },
    created() {
        this.loading = true;
        axios.get(`/api/bookables/${this.$route.params.id}`).then(response => {
            this.loading = false;
            this.bookable = response.data.data;
        });
    }
};
</script>

<template>
    <div>
        <div v-if="loading">Data is loading</div>
        <div v-else>
            <div class="row" v-for="row in rows" :key="'row' + row">
                <div
                    class="col"
                    v-for="(bookable, column) in bookablesInRow(row)"
                    :key="'row' + row + column"
                >
                    <listItem
                        :title="bookable.title"
                        :description="bookable.description"
                        :price="1000"
                    ></listItem>
                </div>

                <div
                    class="col"
                    v-for="p in placeholdersInRow(row)"
                    :key="'placeholder' + row + p"
                ></div>
            </div>

            <!--':' indicAates v-bind: (proprty to define datatype explicitly)-->
        </div>
    </div>
</template>

<script>
import BookableListItem from "./BookableListitemView";
export default {
    components: {
        listItem: BookableListItem
    },

    computed: {
        rows() {
            return this.bookables === null
                ? 0
                : Math.ceil(this.bookables.length / this.columns);
        }
    },
    methods: {
        bookablesInRow(row) {
            return this.bookables.slice(
                (row - 1) * this.columns,
                row * this.columns
            );
        },
        placeholdersInRow(row) {
            return this.columns - this.bookablesInRow(row).length;
        }
    },
    //use of created method is preffered when fetching data from server
    created() {
        this.loading = true;
        const p = new Promise((resolve, reject) => {
            console.log(resolve);
            console.log(reject);
            setTimeout(() => resolve("Hello 1"), 3000);
        })
            .then(result => "Hello 2" + result)
            .then(result => console.log(result))
            .catch(result => console.log(`error ${result}`));
        console.log(p);
        const request = axios.get("/api/bookables").then(response => {
            this.loading = false;
            this.bookables = response.data;
            //console.log("Bookables" + this.bookables);
        });

        console.log(request);
    },
    data() {
        return {
            bookables: null,
            loading: false,
            columns: 3
        };
    }
};
</script>

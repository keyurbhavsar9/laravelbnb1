<template>
    <div>
        <div v-if="loading">Data is loading</div>
        <div v-else>
            <div class="row p-3" v-for="row in rows" :key="'row' + row">
                <div
                    class="col d-flex align-items-stretch"
                    v-for="(bookable, column) in bookablesInRow(row)"
                    :key="'row' + row + column"
                >
                    <listItem v-bind="bookable"></listItem>
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

        const request = axios.get("/api/bookables").then(response => {
            this.loading = false;
            this.bookables = response.data.data;
            this.bookables.push({ title: "x", description: "x" });
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

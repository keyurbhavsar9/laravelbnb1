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
                        :content="bookable.content"
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
        console.log("Created");
        console.log(this.bookabale1);

        setTimeout(() => {
            this.bookables = [
                {
                    title: "Expesive Villa 1",
                    content: "HOUSE 1"
                },
                {
                    title: "Expesive Villa 2",
                    content: "HOUSE 2"
                },
                {
                    title: "Expesive Villa 3",
                    content: "HOUSE 2"
                },
                {
                    title: "Expesive Villa 4",
                    content: "HOUSE 2"
                },
                {
                    title: "Expesive Villa 5",
                    content: "HOUSE 2"
                },
                {
                    title: "Expesive Villa 6",
                    content: "HOUSE 2"
                },
                {
                    title: "Expesive Villa 7",
                    content: "HOUSE 2"
                }
            ];
            this.loading = false;
        }, 2000);
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

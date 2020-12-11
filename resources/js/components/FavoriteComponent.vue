<template>
        <a href="javascript:void(0)" class="fav-btn" v-if="isFavorited" @click.prevent="unFavorite(doctor)" style="background-color: #fb1612; color: #fff;">
            <i class="far fa-bookmark"></i>
        </a>

        <a href="javascript:void(0)" class="fav-btn" v-else @click.prevent="favorite(doctor)" >
            <i class="far fa-bookmark"></i>
        </a>
</template>

<script>
    export default {
        props: ['doctor', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(doctor) {
                axios.post('/favorite/'+doctor)
                    .then((response) => {
                        this.isFavorited = true;
                        flash('This Doctor has been added to your favorites', 'success');
                    })
                    .catch(response => console.log(response.data));
            },

            unFavorite(doctor) {
                axios.post('/unfavorite/'+doctor)
                    .then((response) => {
                        this.isFavorited = false;
                        flash('This Doctor has been removed from your favorites', 'success');
                    })
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
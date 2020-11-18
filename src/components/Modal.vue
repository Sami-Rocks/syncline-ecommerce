<template>
    <div class="overlay"  >
        <div class="modal">
            <div class="modal-image">
                <img :src=image alt="product">
                <p><strike style="fontSize: 13px" >GH¢ {{price}} </strike> GH¢ {{sale}} </p>
            </div>
            <div class="modal-content">
                <div class="modal-title">
                    <h4>{{title}}</h4>
                    <button class="close-btn" @click="toggleVisibility" >
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{description}}</p>
                </div>
                <button @click="addToCart" class="add-to-cart">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Modal',
        props: {
            title: String,
            price: String,
            sale: String,
            image: String,
            description: String
        },
        methods: {
            addToCart(){
                this.$emit('add-event')
                this.toggleVisibility()
            },
            toggleVisibility(){
                this.$emit('close-modal')
            }
            
        }
    }
</script>

<style scoped lang="scss">
    .overlay{
        width: 100vw;
        height: 100vh;
        position: absolute;
        top: 0; bottom: 0; left: 0; right: 0;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0,0, .5);
        .modal{
            border-radius: 3rem;
            width: 60rem;
            padding: 1rem;
            height: 38rem;
            background: white;
            display: flex;
            align-items: center;
            position: relative;
            .modal-image{
                width: 20rem;
                img{
                    width: 20rem;
                    height: 20rem;
                    object-fit: contain;
                }
            }
            .modal-content{
                text-align: left;
                padding: 1rem;
            }
            .modal-title{
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                button{
                    padding: 1rem ;
                    position: absolute;
                    top: .5rem; right: 1rem;
                    background: none;
                    color: black;
                }
            }
        }
        h4{
            font-size: 2.2rem;
            padding: 0; margin: 0;
            margin-bottom: 2rem;
        }
        p{
            font-size: 1.5rem;
            margin-bottom: 3.5rem;
        }
        button{
            border: none;
            background: black;
            color: #FDC20C;
            border-radius: .5rem;
            padding: 1rem 2rem;
            font-size: 1.7rem;
            cursor: pointer;
        }
    }
    
</style>
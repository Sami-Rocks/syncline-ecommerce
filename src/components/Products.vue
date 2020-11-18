<template>
        <div className="product">
            <div className="product-header">
                <div className="open" @click="toggleVisibility" >
                    <svg width=".1rem" height=".1rem" viewBox="0 0 16 16" class="bi bi-arrows-angle-expand" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>
                    </svg>
                </div>
                <div className="add-to-cart" @click="addToCart" >
                    <img src="./../assets/add_to_cart.svg"  alt='cart' />
                </div>
            </div>
            <div className="product-image-background">
                <div className="product-background">
                    <div className="rect" v-bind:style="{backgroundColor: colors[Math.floor(Math.random() * colors.length)]  }" >
                        <div className="circle"></div>
                    </div>
                </div>
                <div className="product-image" @click="toggleVisibility" >
                    <img :src=image alt='product' />
                </div>
            </div>
            <div className="product-title">
                <h4> {{title}} </h4>
            </div>
            <div className="product-price">
                <p><strike style="fontSize: 13px" >GH¢ {{price}} </strike> GH¢ {{sale}} </p>
            </div>
        </div>              
        <Modal v-if="isVisible"
            v-bind:image="image"
            v-bind:title="title"
            v-bind:price="price"
            v-bind:sale="sale"
            v-bind:description="description"
            v-on:add-event="addToCart()"
            v-on:close-modal="toggleVisibility()"
        ></Modal>
</template>
<script>
    import Modal from './Modal';

    export default {
        name: 'Products',
        components: {
            Modal
        },
        props: {
            title: String,
            price: String,
            sale: String,
            image: String,
            description: String
        },
        data: () => {
            return{
                colors: ['#45409C','#01AF67', '#FF6B01'],
                isVisible: false
            }
        },
        methods: {
            addToCart(){
                this.$emit("add-event")
            },
            toggleVisibility(){
                this.isVisible = !this.isVisible
            }
        }
    }
</script>

<style lang="scss">

</style>

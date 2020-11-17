<template>
        <div className="product">
            <div className="product-header">
                <div className="open" >
                    <img src="./../assets/expand.svg" alt='expand'/>
                </div>
                <div className="add-to-cart">
                    <img src="./../assets/add_to_cart.svg"  alt='cart' />
                </div>
            </div>
            <div className="product-image-background">
                <div className="product-background">
                    <div className="rect" v-bind:style="{backgroundColor: colors[Math.floor(Math.random() * colors.length)]  }" >
                        <div className="circle"></div>
                    </div>
                </div>
                <div className="product-image" >
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
</template>

<script>
    export default {
        name: 'Products',
        props: {
            title: String,
            price: String,
            sale: String,
            image: String,
            addToCart: Function
        },
        data: () => {
            return{
                colors: ['#45409C','#01AF67', '#FF6B01']
            }
        }
    }
</script>

<style lang="scss">

</style>

<template>
    <div class="cart-list">
        <div class="cart-product-image">
            <img :src=image alt="cart-product"  />
        </div>
        <div class="cart-product-title-price">
            <h4>{{title}}</h4>
            <p>GH¢ {{price}}</p>
        </div>
        <div class="remove-button">
            <button class="rm-btn" >
                X
            </button>
        </div>
    </div>
</template>


<script>
    export default {
        name: 'Cart',
        props: {
            title: String,
            price: String,
            image: String,
        }
    }
</script>
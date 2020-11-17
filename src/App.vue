<template>
    <div class="App" >
        <div class="header">
            <div class="logo">
                SamiLogo
            </div>
            <div class="cart">
                <img src="./assets/add_to_cart.svg" alt='cart'/>
            </div>
        </div>
        <div class="main-content" >
            <div class="shop">
                <h2>Shop</h2>
                <div class="product-list" > 
                    <Products 
                        @created="handleCreated"
                        v-for="product in products"  
                        v-on:click="addToCart(product)"
                        v-bind:key="product.id"
                        v-bind:image="product.better_featured_image.source_url"
                        v-bind:title="product.title.rendered"
                        v-bind:price="product._regular_price"
                        v-bind:sale="product._sale_price"
                    ></Products>
                </div>
            </div>
            <div class="cart" >
                <h2>Cart</h2>
                <div class="cart-lists">
                    <Cart 
                        v-for="cartItem in cart"
                        v-on:click="removeProduct(cartItem)"
                        v-bind:key="cartItem.id"
                        v-bind:image="cartItem.better_featured_image.source_url"
                        v-bind:title="cartItem.title.rendered"
                        v-bind:price="cartItem._regular_price"
                        v-bind:sale="cartItem._sale_price"
                    ></Cart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Products from './components/Products';
    import Cart from './components/Cart';
    import data from './data.json';
    import axios from 'axios'

    export default {
        name: 'App',
        components: {
            Products,
            Cart
        },
        created: function() {
            axios
            .get('http://localhost/ecommerce/?rest_route=/wp/v2/product')
            .then(response =>{
                (console.log(response.data[0]['better_featured_image']['source_url']))
                this.products = response.data
                console.log(this.products)
            })
        },
        data: () => {
            return {
                products: data.products,
                cart: []
            }
        },
        methods: {
            handleCreated(){
                console.log('Childed component created')
            },
            addToCart(product){
                this.cart.push(product)
                console.log(this.cart)
            },
            removeProduct(item){
                this.cart.splice(this.cart.indexOf(item),1)
                console.log(this.cart)
            }
        }
    }
</script>

<style lang="scss">
    $orange :#FF6B01;
    $blue: #45409C;
    $green: #01AF67;
    $yellow: #FDC20C;

    $clear: #FFE9BE;

    $background_color: #FFEBC1;

html {
    font-size: 62.5%;
    box-sizing: border-box;
}


body, #app{
    background: $background_color;
    height: 100vh;
    margin: 0;
    font-family: 'Lato', sans-serif;
}

.App{
    height: 100%;
    max-width: 145rem;
    margin: 0 auto;

    
    .header{
        height: 5rem;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        
        padding: 0 1rem;
        .logo{
            font-size: 1.7rem;
        }
        .cart{
            img{
                width: 2rem;
                height: 2rem;
            }
        }
    }
    
    .main-content{
        text-align: center;
        h2{margin: .3rem; margin-bottom: 2rem;}
        
        display: flex;
        gap: 4rem;
        .shop{
            padding: 2rem;
            background: $yellow;
            height: 28rem;
            margin: 0;     
            width: fit-content !important;
        }
        
        .product-list{
            display: flex;
            flex-direction: row;
            justify-content: center; 
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
            width: fit-content !important;
            .product{
                flex: 1 1 29rem;
                width: 25rem;
                cursor: pointer;
                max-width: 25rem;
                height: 28rem;
                padding: 1rem;
                background: white;
                background: radial-gradient(circle, rgba(242,161, 102,1) 10%, white 70%);
                transition: .5s all ease;
                border-radius: 2rem;
                h4{color: $blue ;margin: .1rem;}
                p{color: #717195; margin: .1rem;}
                
                .product-header{
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    padding: .2rem;
                    transition: .5s all ease;
                    img{
                        width: 1.52rem;
                        height: 1.52rem;
                        border: .1rem solid #ccc;
                        border-radius: 50%;
                        padding: .5rem;
                    }
                }
                
                .product-image-background{
                    width: 80%;
                    height: 63%;
                    margin: .5rem auto;
                    position: relative;
                    .product-background{
                        height: 50%;
                        border-radius: 1rem;
                        overflow: hidden;
                        position: relative;
                        .rect{
                            height: 100%;
                            .circle{
                                transition: .5s all ease;
                                background: $yellow;
                                position: absolute;
                                width: 12rem;
                                height: 12rem;
                                border-radius: 50%;
                                top: -.6rem; left: 25%;
                                border: .3rem solid $clear;
                            }
                        }
                    }
                    .product-image{
                        position: absolute;
                        top: 1rem;
                        transition: .5s all ease;
                        img{
                            width: 100%;
                            height: auto;
                            object-fit: cover;
                        }
                    }
                }
                .product-title{
                    font-size: 1.5rem;
                }
                .product-price{
                    font-size: 2rem;
                }
            }
            .product:hover{
                .product-header{            
                    img:hover{
                        transform: rotate(15deg);
                    }
                }
                .product-image-background{
                    .product-background{
                        .rect{
                            .circle{
                                left: 15%;
                                top: -.9rem;
                                width: 15rem;
                                height: 15rem;
                            }
                        }
                    }
                    .product-image{
                        transform: rotate(-15deg);
                    }
                }
                
            }
        }

        

        .cart{
            display: none;
            width: 40rem;
            height: 28rem;
            background: $green;
            border-radius: 3rem;
            padding: 2rem 0;
            .cart-lists{
                width: 100%;
                height: 10rem;
                .cart-list{
                    padding: 2rem;
                    transition: .5s all ease;
                    cursor: pointer;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                    .cart-product-image{
                        width: 4rem;
                        height: 4rem;
                        overflow: hidden;
                        object-fit: cover;
                        img{
                            width: 4rem;
                            height: 4rem;
                            object-fit: cover;
                        }
                    }
                    .cart-product-title-price{
                        text-align: left;
                        overflow: hidden;
                        p{
                            margin: 0;
                            font-size: 1.5rem;
                        }
                        h4{font-size: 2rem; margin: 0;}
                    }
                    .rm-btn{
                        background: black;
                        color: $yellow;
                        border: none;
                        padding: .8rem 1rem;
                        font-weight: 900;
                    }
                }
                .cart-list:hover{
                    background: $yellow;
                }
            }
        }
    }

}
        .product-modal{
            display: flex;
            text-align: center;
            flex-direction: column;
            justify-content: center;
            padding: 1rem;
            .product-modal-title{
                font-size: 3rem;
                color: $blue;
            }
            .product-modal-description{
                font-size: 1.5rem;
                color: $blue;
                padding: 2rem;
                padding-top: .41rem;
            }
            .product-modal-image{
                margin: auto;
                overflow: hidden;
                height: 25rem;
                width: 25rem;
                border-top: .21rem solid $orange;
                border-bottom: .21rem solid $orange;
                border-radius: 50%;
                display: flex;
                align-items: center;
                -webkit-box-shadow: 0px 3px 28px 0px rgba($orange, 0.37);
                -moz-box-shadow:    0px 3px 28px 0px rgba($orange, 0.37);
                box-shadow:         0px 3px 28px 0px rgba($orange, 0.37);
                    .product-modal-circle{
                        height: 22rem;
                        width: 22rem;
                        overflow: hidden;
                        border-radius: 50%;
                        margin: auto;
                        background-color: #FFEFCB;
                        -webkit-box-shadow: 0px -3px 22px 0px rgba(218, 223, 223, 0.56);
                        -moz-box-shadow:    0px -3px 22px 0px rgba(218, 223, 223, 0.56);
                        box-shadow:         0px -3px 22px 0px rgba(218, 223, 223, 0.56);
                        img{
                            margin-top: 15%;
                            width: 18rem;
                            height: auto;
                            object-fit: cover;
                        }
                    }
            }
            .product-modal-button{
                padding: 1.2rem;
                border: none;
                font-weight: 700;
                margin: 2.5rem;
                font-size: 1.6rem;
                border-radius: 2rem;
                background: black;
                color: $yellow;
            }
        }
.close{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1.2rem;
    height: 1.2rem;
    border-radius: 50%;
    padding: 1rem;
    position: absolute;
    cursor: pointer;
    right: 2.5rem;
    img{
        width: 1.7rem;
        height: 1.7rem;
    }
}

@media only screen and (min-width: 600px) {
    .header{
        margin: auto 4rem;
        padding: 0;
    }
    .main-content{
        margin: auto 4rem;
        .shop{
            border-radius: 3rem;
        }
    }
}
@media only screen and (min-width: 995px) {
    .header{
        margin: auto 4rem;
    }
    .main-content{
        .cart{
            display: block !important;
        }
    }
    .product-modal{
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
        text-align: left;
    }
}
</style>

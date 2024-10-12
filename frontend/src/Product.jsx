import React from 'react';

const Product = ({ product }) => {
    return (
        <div className="product-card">
            <img src={product.image} alt={product.name} />
            <h2 className="product-title">{product.name}</h2>
            <p className="product-description">{product.description}</p>
            <p className="product-price">${parseFloat(product.price).toFixed(2)}</p>
        </div>
    );
};

export default Product;

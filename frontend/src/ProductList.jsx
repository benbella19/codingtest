import React, { useEffect, useState } from 'react';
import Product from './Product';

const ProductList = () => {
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [sortOrder, setSortOrder] = useState('name');  
    const [filterCategory, setFilterCategory] = useState('');  
    const [categories, setCategories] = useState([]);

    useEffect(() => {
         
        const fetchCategories = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/categories');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                setCategories(data);  
            } catch (err) {
                setError(err.message);
            }
        };

        fetchCategories();
    }, []);  

    useEffect(() => {
         const fetchProducts = async () => {
            setLoading(true);  
            try {
                 
                const response = await fetch(`http://127.0.0.1:8000/api/products?sort_by=${sortOrder}&category_id=${filterCategory}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                setProducts(data.data);  
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchProducts();
    }, [sortOrder, filterCategory]);  

    const handleSortChange = (e) => {
        setSortOrder(e.target.value);
    };

    const handleFilterChange = (e) => {
        setFilterCategory(e.target.value);
    };

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>Error: {error}</div>;
    }

    return (
        <div>
            
            <div className="sorting">
                <label htmlFor="sort">Sort by:</label>
                <select id="sort" value={sortOrder} onChange={handleSortChange}>
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                </select>
            </div>

             
            <div className="filtering">
                <label htmlFor="filter">Filter by category:</label>
                <select id="filter" value={filterCategory} onChange={handleFilterChange}>
                    <option value="">All Categories</option>
                    {categories.map((category) => (
                        <option key={category.id} value={category.id}>{category.name}</option>
                    ))}
                </select>
            </div>

            <div className="product-list">
                {products.map(product => (
                    <Product key={product.id} product={product} />
                ))}
            </div>
        </div>
    );
};

export default ProductList;

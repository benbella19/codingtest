import './App.css';
import CreateProduct from './CreateProduct';
import ProductList from './ProductList';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';


function App() {
  return (
    <Router>
    <div>
      <Link to="/create-product">
        <button className="add-product-button">Ajouter Produit</button>
      </Link>

      <Link to="/">
        <button className="add-product-button">List Produit</button>
      </Link>
      
      <Routes>
        <Route path="/" element={<ProductList />} />
        <Route path="/create-product" element={<CreateProduct />} />
      </Routes>
    </div>
  </Router>
  );
}

export default App;

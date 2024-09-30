import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Header from "./shared/Header";
import Home from "./features/Home";
import Footer from "./shared/Footer";
import AboutUs from "./features/AboutUs";
import Media from "./features/Media";
import Subscribe from "./features/Subscribe";

function App() {
  return (
    <Router>
      <Header />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/about-us" element={<AboutUs />} />
        <Route path="/media" element={<Media />} />
        <Route path="/subscribe" element={<Subscribe />} />
      </Routes>
      <Footer />
    </Router>
  );
}

export default App;

import React from "react";
import Header from "../src/shared/Header";
import Footer from "../src/shared/Footer";
import type { AppProps } from "next/app";
import "../src/index.css";

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <>
      <Header />
      <Component {...pageProps} />
      <Footer />
    </>
  );
}

export default MyApp;

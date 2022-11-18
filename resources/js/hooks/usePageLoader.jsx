import React from "react";
import PageLoader from "../components/pageLoader/Index";
import { useState } from "react";

const usePageLoader = () => {
    const [loading, setLoading] = useState(false);
    return[
        loading ? <PageLoader /> : null,
        () => setLoading(true),
        () => setLoading(false)
    ]
}

export default usePageLoader;
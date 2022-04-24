import {useEffect, useState} from "react";

export const UseFetch = (url: RequestInfo) => {
    const [data, setData] = useState<any>();
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const fetchData = async () => {
        setLoading(true);
        try {
            const response = await fetch(url);
            const data = await response.json();
            setData(data["hydra:member"]);
            setLoading(false);
        } catch (error) {
            setError(true);
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchData();
    }, []);
    return {data, loading, error};
};

export const UseFetchSingle = (url: RequestInfo) => {
    const [data, setData] = useState<any>();

    const fetchData = async () => {

        try {
            const response = await fetch(url);
            const data = await response.json();
            setData(data)

        } catch (error) {
            console.log(error)
        }
    };

    useEffect(() => {
        fetchData();
    }, []);
    return {data};
};
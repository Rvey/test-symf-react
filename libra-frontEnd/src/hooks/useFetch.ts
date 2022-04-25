import { useEffect, useState } from "react";

export const UseFetch = (url: RequestInfo) => {
  const [data, setData] = useState<any>();

  const fetchData = async () => {
    try {
      const response = await fetch(url);
      const data = await response.json();
      setData(data["hydra:member"]);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchData();
  }, []);
  return { data };
};

export const UseFetchSingle = (url: RequestInfo) => {
  const [data, setData] = useState<any>();
  const [refetch, setRefetch] = useState(false);
  const fetchData = async () => {
    try {
      const response = await fetch(url);
      const data = await response.json();
      setData(data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchData();
  }, [refetch]);

  const getData = () => {
    fetchData();
  };
  return { data, getData };
};

export const UseFetchResult = (url: RequestInfo, searchKey: string) => {
  const [searchData, setSearchData] = useState([]);

  const fetchData = async () => {
    try {
      const response = await fetch(url);
      const data = await response.json();
      setSearchData(data["hydra:member"]);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    fetchData();
  }, [searchKey]);
  return { searchData };
};

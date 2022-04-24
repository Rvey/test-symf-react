import React, {useEffect, useState} from 'react';
import BookCard from "../components/bookCard";
import Hero from "../components/hero";
import {UseFetch} from "../hooks/useFetch";
import {useNavigate} from "react-router-dom";

const Books = () => {
    const [search, setSearch] = useState('')
    const [searchData, setSearchData] = useState([])
    let {data} = UseFetch(`https://127.0.0.1:8000/api/books`)


    const seachedData = async () => {

        const response = await fetch(`https://127.0.0.1:8000/api/books?page=1&title=${search}`);
        const data = await response.json();
        setSearchData(data["hydra:member"])
    }
    useEffect(() => {

        seachedData()
    }, [search])

    console.log(searchData)


    const navigate = useNavigate()
    return (
        <div>
            <Hero/>


            <div className="mb-6">
                <input type="text" value={search} onChange={(e) => setSearch(e.target.value)}
                       className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       placeholder="Enter Book title"
                />
            </div>

            <h1 className={"text-3xl font-bold my-14"}>Collection</h1>
            <div className={"flex gap-10 flex-wrap"}>


                {
                    searchData.length < 0 ?

                        data && data?.map((book: any) => (

                            <div key={book.id} onClick={() => navigate(`/bookReview/${book.id}`)}>

                                <BookCard title={book.title} author={book.author} genre={book.genre}/>
                            </div>
                        ))
                        :
                        searchData && searchData?.map((book: any) => (

                            <div key={book.id} onClick={() => navigate(`/bookReview/${book.id}`)}>

                                <BookCard title={book.title} author={book.author} genre={book.genre}/>
                            </div>
                        ))
                }

            </div>
        </div>
    );
};

export default Books;
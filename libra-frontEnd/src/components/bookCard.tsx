import React from 'react';

const BookCard = ({title, author, genre}: any) => {

    return (
        <div className={"bg-black h-[15em] w-[12em] rounded-md group relative"}>
            <div
                className={"h-[15em] w-[12em] bg-red-400 rounded-md flex flex-col justify-between p-2 hover:-translate-x-2 hover:-translate-y-2 transition-all cursor-pointer"}>
                <h1 className={"text-white font-bold text-xl truncate text-ellipsis overflow-hidden"}>{title}</h1>
                <div className={"bg-gray-300 p-2 rounded-md bg-opacity-50"}>

                    <h1 className={"text-white font-bold text-xl"}>{genre}</h1>
                    <h1 className={"text-white font-bold text-xl text-gray-800"}>{author["firstName"]} {author["lastName"]}</h1>
                </div>
                <h1 className={"text-white font-bold text-xl group-hover:block hidden border-gray-50 border-4 text-center "}>More
                    Info</h1>

            </div>
        </div>
    );
};


export default BookCard;
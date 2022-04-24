import React from "react";
import {useParams} from "react-router-dom";
import dayjs from "dayjs";
import {UseFetchSingle} from "../hooks/useFetch";

const BookReview = () => {
    const params = useParams();
    const {data: book} = UseFetchSingle(`https://127.0.0.1:8000/api/books/${params.id}`);


    return (
        <div className="bg-white">
            {!book ? <div>Loading...</div> :
                <div className="pt-6 ">
                    {/* book title */}
                    <div className="mt-6 max-w-2xl mx-auto py-6 lg:max-w-7xl  font-bold text-5xl">
                        <h1>{book.title}</h1>
                    </div>

                    {/* Product info */}
                    <div
                        className="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8  lg:gap-x-8 lg:gap-y-8">
                        <div className="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8 mb-14">
                            <h1 className="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-2xl mb-4">
                                Author
                            </h1>
                            <h1 className="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
                                {book.author["firstName"]} {book.author["lastName"]}
                            </h1>
                        </div>

                        <div
                            className="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8 bg-gray-200 p-4">
                            {/* Description and details */}
                            <div>
                                <h3 className="text-sm font-medium text-gray-900">Description</h3>

                                <div className="space-y-6">
                                    <p className="text-base text-gray-900">{book.description}</p>
                                </div>
                            </div>

                            <div className="mt-10">
                                <h2 className="text-sm font-medium text-gray-900">Genre</h2>

                                <div className="mt-4 space-y-6">
                                    <p className="text-sm text-gray-600">{book.genre}</p>
                                </div>
                            </div>
                            <div className="mt-10">
                                <h2 className="text-sm font-medium text-gray-900">
                                    PublicationDate
                                </h2>

                                <div className="mt-4 space-y-6">
                                    <p className="text-sm text-gray-600">{dayjs(book.publicationDate).format('YYYY-MM-DD')}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Review */}
                    <div
                        className="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8  lg:gap-x-8 lg:gap-y-8 mt-4 flex flex-col justify-between px-4 max-w-2xl ">
                        <h2 className="text-md font-medium text-gray-900 mb-3">
                            Book Review
                        </h2>
                        <div className="flex flex-col gap-4">

                            <input
                                className="w-full py-4 pl-3 pr-16 text-sm border-2 border-gray-200 rounded-lg"
                                type="text"
                                placeholder="full name"/>
                            <input
                                className="w-full py-4 pl-3 pr-16 text-sm border-2 border-gray-200 rounded-lg"
                                type="text"
                                placeholder="email"/>
                            <input
                                className="w-full py-4 pl-3 pr-16 text-sm border-2 border-gray-200 rounded-lg"
                                type="text"
                                placeholder="comment"/>

                        </div>
                        <button
                            className=" p-2 px-4 text-white -translate-y-1/2 bg-blue-600 rounded-md top-1/2 right-4 text-sm"
                            type="button">
                            Add Review
                        </button>
                        <div>
                            {
                                //@ts-ignore
                                book.reviews.map((review) => (
                                    <div key={review.id} className={"bg-gray-200 p-4 rounded-md"}>
                                        <div className={"flex gap-[10em] justify-between m-3 "}>
                                            <div className={"flex gap-32 font-semibold"}>
                                                <h1>{review.email}</h1>
                                                <h1>{review.fullName}</h1>
                                            </div>

                                            <h1>{dayjs(review.creationDate).format('DD/MM/YYYY')}</h1>
                                        </div>
                                        <h1 className={"p-4 bg-gray-400 rounded-md"}>{review.comment}</h1>

                                    </div>
                                ))
                            }
                        </div>
                    </div>
                </div>
            }
        </div>
    );
};

export default BookReview;

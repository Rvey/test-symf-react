import {BrowserRouter, Route, Routes} from "react-router-dom";
import Books from "./Pages/books";
import BookReview from "./Pages/bookReview";

function App() {

    return (
        <div className="App mx-auto w-[80%] ">
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Books/>}/>
                    <Route path="/bookReview" element={<BookReview/>}>
                        <Route path="/bookReview/:id" element={<BookReview/>}/>
                    </Route>
                </Routes>
            </BrowserRouter>

        </div>
    )
}

export default App

import React from "react";
import ReactDOM from "react-dom";


function Example() {
    return (
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="row justify-content-center">
                <div class="col-md-12 my-auto">
                    <h1 class="mb-0">Google Keep Clone</h1>
                    <p>Under Construction!</p>
                    <button>ss</button>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById("example")) {
    ReactDOM.render(<Example />, document.getElementById("example"));
}

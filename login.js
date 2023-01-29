const React = require("react");
const ReactDOM = require("react-dom");

//import React, { useState } from "react";
//import ReactDOM from "react-dom";

function login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    function handleSubmit(event) {
        event.preventDefault();
        // send a request to the server ro authenticate the user
        fetch("/api/login", {
            method: "POST",
            body: JSON.stringify({ email, password }),
            headers: { "Content-Type": "application/json" },
        })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                // redirect the user to the appropriate page
                window.location.href = "/dashboard";
            } else {
                // show error message
                alert("Incorrect email or password.");
            }
        });
    }

    return (
        <form onSubmit={handleSubmit}>
          <label>
            Email:
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </label>
          <br />
          <label>
            Password:
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </label>
          <br />
          <button type="submit">Login</button>
        </form>
      );    
}

ReactDOM.render(<Login />, document.getElementById("root"));
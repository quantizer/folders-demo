import ReactDOM from "react-dom";
import React from 'react';
import FolderContainer from "./components/FolderContainer";

require('../css/app.scss');

var folders = [];

$(document).ready(function () {
    $.getJSON('/folder/all').done(function (response) {
        folders = response;

        ReactDOM.render(<FolderContainer folders={folders}/>, document.getElementById("foldersContainer"));
    });
});

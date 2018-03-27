import React from 'react';
import CreateFolder from './CreateFolder'
import FolderList from './FolderList'

class FolderContainer extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            value: '',
            currentParent: null,
            folders: props.folders,
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleFolderItemClick = this.handleFolderItemClick.bind(this);
    }

    handleSubmit(event) {
        event.preventDefault();
        // event.stopPropagation();

        this.createFolder(this.state.value);
    }

    handleChange(event) {
        this.setState({value: event.target.value});
    }

    handleFolderItemClick(folder) {
        this.setState({currentParent: folder});
    };

    createFolder(name) {
        let data = {'folder_name': name};
        let self = this;
        const { currentParent } = this.state;

        if (currentParent) {
            data.parent_folder_id = currentParent.id;
        }

        if (name) {
            $.post('/folder/new', data).done(function (response) {
                self.setState({
                    folders: response,
                    value: '',
                });
            });
        }
    }

    render() {
        const { value, folders, currentParent } = this.state;

        return (
            <div>
                <FolderList
                    onItemClick={this.handleFolderItemClick}
                    folders={folders}
                />
                <CreateFolder
                    parent={currentParent}
                    onSubmitForm={this.handleSubmit}
                    onChangeInput={this.handleChange}
                    value={value}
                />
            </div>
        )
    }
}

export default FolderContainer;

import React from 'react';
import FolderList from './FolderList'

class FolderItem extends React.Component {
    render() {
        const {folder, onItemClick} = this.props;

        return (
            <li key={folder.id}>
                <div>
                    { folder.name }
                    { folder.child_folders ? <FolderList onItemClick={onItemClick} folders={folder.child_folders} /> : `` }
                </div>
                <button onClick={(e) => onItemClick(folder, e)}>Select</button>
            </li>
        )
    }
}

export default FolderItem;

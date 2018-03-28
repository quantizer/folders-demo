import React from 'react';
import FolderList from './FolderList'

class FolderItem extends React.Component {
    render() {
        const {folder, onItemClick} = this.props;

        return (
            <li key={folder.id}>
                <div>
                    { folder.name }
                    <button type="button" className="btn btn-link btn-sm" onClick={(e) => onItemClick(folder, e)}>Select</button>
                    { folder.child_folders ? <FolderList onItemClick={onItemClick} folders={folder.child_folders} /> : `` }
                </div>

            </li>
        )
    }
}

export default FolderItem;

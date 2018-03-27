import React from 'react';
import FolderItem from './FolderItem'

class FolderList extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        const { folders, onItemClick } = this.props;
        const listItems = folders.map((folder) => <FolderItem key={folder.id} folder={folder} onItemClick={onItemClick} />);

        return (
            <div>
                <ul>
                    {listItems}
                </ul>
            </div>
        )
    }
}



export default FolderList;

import React from 'react';

class CreateFolder extends React.Component {
    render() {
        const {onSubmitForm, onChangeInput, value, parent } = this.props;

        return (
            <div>
                Add to folder: { parent ? parent.name : `root` }
                <form onSubmit={onSubmitForm}>
                    <input placeholder={'Folder name'} type="text" value={value} onChange={onChangeInput}/>
                    <button>Create folder</button>
                </form>
            </div>
        )
    }
}

export default CreateFolder;

import React from 'react';

class CreateFolder extends React.Component {
    render() {
        const {onSubmitForm, onChangeInput, value, parent } = this.props;

        return (
            <div className="col-lg-3 col-sm-12 col-md-6">
                <h4>Add to folder: { parent ? parent.name : `root` }</h4>
                <form onSubmit={onSubmitForm}>
                    <div className="form-group">
                        <label htmlFor="folder_name">Folder name</label>
                        <input className="form-control" name="folder_name" placeholder={'Enter folder name'} type="text" value={value} onChange={onChangeInput}/>
                    </div>
                    <button className="btn btn-primary">Create folder</button>
                </form>
            </div>
        )
    }
}

export default CreateFolder;

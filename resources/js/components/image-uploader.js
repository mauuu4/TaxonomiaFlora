export default function imageUploader(inputName, maxImages = 5) {
    return {
        inputName,
        maxImages,
        previews: [],
        
        handleFiles(event) {
            const files = Array.from(event.target.files);
            
            if (files.length > this.maxImages) {
                alert(`Solo se permiten hasta ${this.maxImages} imágenes`);
                event.target.value = '';
                return;
            }
            
            this.previews = files.map(file => ({
                id: Math.random().toString(36).substring(7),
                url: URL.createObjectURL(file),
                file: file,
                description: ''
            }));
        },
        
        removeImage(index) {
            URL.revokeObjectURL(this.previews[index].url);
            this.previews.splice(index, 1);
        }
    };
}
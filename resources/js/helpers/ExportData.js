export default {
  exportCallback(response){
      const data = response.data;
      const type = response.headers['content-type'];
      console.log(type);
      const blob = new Blob([data], {type});
      const url = URL.createObjectURL(blob);
      const filename = response.headers['content-disposition'].replace("attachment; filename=\"", "").replace('"', '');

      const link = document.createElement('a');
      link.innerText = "Download";
      document.body.appendChild(link);
      link.download = filename;
      link.href = url;
      link.click();
      document.body.removeChild(link);
  }
}
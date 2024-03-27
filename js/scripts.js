function confirmDelete() {
    if (confirm('Are you sure you want to delete this?') == true) {
      // user clicked OK so execute the link
      return true;
    }
    else {
      // user clicked Cancel so stop execution
      return false;
    }
  }
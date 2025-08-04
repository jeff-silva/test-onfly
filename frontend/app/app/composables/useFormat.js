export default () => {
  const scope = {};

  scope.date = (dateTime) => {
    if (!dateTime) return "";
    const [y, m, d] = dateTime.split(/[^0-9]/g);
    return [d, m, y].join("/");
  };

  return scope;
};

export function featureFlag(lookingFor, page) {
    let results = _.find(page.props.features, (item) => {
        return item.feature == lookingFor;
    })

    return results != null;
}
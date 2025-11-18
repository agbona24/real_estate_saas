import React from 'react';
import {
    Box,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    IconButton,
    useColorModeValue,
    HStack,
    Text,
    Select,
} from '@chakra-ui/react';
import { Eye, Download, FileText, File, Image as ImageIcon } from 'lucide-react';

const Documents = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const documents = [
        {
            id: 1,
            name: 'Purchase Agreement - 123 Main St',
            type: 'contract',
            category: 'Purchase',
            property: '123 Main St',
            size: '2.4 MB',
            date: '2024-03-15',
            status: 'signed',
        },
        {
            id: 2,
            name: 'Title Deed - 123 Main St',
            type: 'pdf',
            category: 'Legal',
            property: '123 Main St',
            size: '856 KB',
            date: '2024-03-20',
            status: 'active',
        },
        {
            id: 3,
            name: 'Home Inspection Report',
            type: 'pdf',
            category: 'Inspection',
            property: '123 Main St',
            size: '3.2 MB',
            date: '2024-03-10',
            status: 'archived',
        },
        {
            id: 4,
            name: 'Mortgage Agreement',
            type: 'contract',
            category: 'Financial',
            property: '123 Main St',
            size: '1.8 MB',
            date: '2024-03-15',
            status: 'active',
        },
        {
            id: 5,
            name: 'Property Insurance Policy',
            type: 'pdf',
            category: 'Insurance',
            property: '123 Main St',
            size: '645 KB',
            date: '2024-03-18',
            status: 'active',
        },
        {
            id: 6,
            name: 'Purchase Agreement - 789 Pine Rd',
            type: 'contract',
            category: 'Purchase',
            property: '789 Pine Rd',
            size: '2.1 MB',
            date: '2023-11-20',
            status: 'signed',
        },
        {
            id: 7,
            name: 'Title Deed - 789 Pine Rd',
            type: 'pdf',
            category: 'Legal',
            property: '789 Pine Rd',
            size: '912 KB',
            date: '2023-11-25',
            status: 'active',
        },
        {
            id: 8,
            name: 'Property Tax Statement 2025',
            type: 'pdf',
            category: 'Tax',
            property: '123 Main St',
            size: '234 KB',
            date: '2025-11-10',
            status: 'new',
        },
        {
            id: 9,
            name: 'HOA Agreement',
            type: 'contract',
            category: 'HOA',
            property: '123 Main St',
            size: '567 KB',
            date: '2024-03-15',
            status: 'active',
        },
        {
            id: 10,
            name: 'Appraisal Report',
            type: 'pdf',
            category: 'Appraisal',
            property: '789 Pine Rd',
            size: '1.9 MB',
            date: '2023-11-15',
            status: 'archived',
        },
    ];

    const getFileIcon = (type) => {
        switch (type) {
            case 'image':
                return ImageIcon;
            case 'contract':
                return FileText;
            default:
                return File;
        }
    };

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>My Documents</Heading>
                <HStack spacing={3}>
                    <Select placeholder="All properties" w="180px">
                        <option value="123-main">123 Main St</option>
                        <option value="789-pine">789 Pine Rd</option>
                    </Select>
                    <Select placeholder="All categories" w="180px">
                        <option value="purchase">Purchase</option>
                        <option value="legal">Legal</option>
                        <option value="inspection">Inspection</option>
                        <option value="financial">Financial</option>
                        <option value="insurance">Insurance</option>
                        <option value="tax">Tax</option>
                        <option value="hoa">HOA</option>
                        <option value="appraisal">Appraisal</option>
                    </Select>
                </HStack>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Document Name</Th>
                            <Th>Category</Th>
                            <Th>Property</Th>
                            <Th>Size</Th>
                            <Th>Date</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {documents.map((doc) => (
                            <Tr key={doc.id}>
                                <Td>
                                    <HStack spacing={2}>
                                        {React.createElement(getFileIcon(doc.type), { size: 18 })}
                                        <Text fontWeight="semibold" fontSize="sm">
                                            {doc.name}
                                        </Text>
                                    </HStack>
                                </Td>
                                <Td>
                                    <Badge>{doc.category}</Badge>
                                </Td>
                                <Td fontSize="sm">{doc.property}</Td>
                                <Td fontSize="sm">{doc.size}</Td>
                                <Td fontSize="sm">{doc.date}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            doc.status === 'signed' || doc.status === 'active'
                                                ? 'green'
                                                : doc.status === 'new'
                                                ? 'blue'
                                                : 'gray'
                                        }
                                    >
                                        {doc.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Eye size={16} />}
                                            size="sm"
                                            colorScheme="blue"
                                            variant="ghost"
                                            aria-label="View document"
                                        />
                                        <IconButton
                                            icon={<Download size={16} />}
                                            size="sm"
                                            colorScheme="green"
                                            variant="ghost"
                                            aria-label="Download document"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Documents;

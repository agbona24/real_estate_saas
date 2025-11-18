import React from 'react';
import {
    Box,
    Button,
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
import { Plus, Eye, Download, Trash2, FileText, File, Image as ImageIcon } from 'lucide-react';

const Documents = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const documents = [
        {
            id: 1,
            name: 'Purchase Agreement - 123 Main St',
            type: 'contract',
            category: 'Transaction',
            relatedTo: 'John Smith',
            size: '2.4 MB',
            date: '2025-11-15',
            status: 'signed',
        },
        {
            id: 2,
            name: 'Property Listing - Lakeside Villa',
            type: 'pdf',
            category: 'Listing',
            relatedTo: '789 Pine Rd',
            size: '1.8 MB',
            date: '2025-11-12',
            status: 'active',
        },
        {
            id: 3,
            name: 'Client Agreement - Emily Davis',
            type: 'contract',
            category: 'Client',
            relatedTo: 'Emily Davis',
            size: '856 KB',
            date: '2025-11-10',
            status: 'signed',
        },
        {
            id: 4,
            name: 'Property Photos - Downtown Condo',
            type: 'image',
            category: 'Marketing',
            relatedTo: '123 Main St',
            size: '12.3 MB',
            date: '2025-11-08',
            status: 'published',
        },
        {
            id: 5,
            name: 'Inspection Report - Suburban Home',
            type: 'pdf',
            category: 'Inspection',
            relatedTo: '456 Oak Ave',
            size: '3.2 MB',
            date: '2025-11-05',
            status: 'reviewed',
        },
        {
            id: 6,
            name: 'Commission Statement - October',
            type: 'pdf',
            category: 'Financial',
            relatedTo: 'October 2025',
            size: '245 KB',
            date: '2025-11-01',
            status: 'approved',
        },
        {
            id: 7,
            name: 'License Certificate',
            type: 'pdf',
            category: 'Professional',
            relatedTo: 'Real Estate License',
            size: '512 KB',
            date: '2024-01-15',
            status: 'active',
        },
        {
            id: 8,
            name: 'Training Certificate - Ethics',
            type: 'pdf',
            category: 'Training',
            relatedTo: 'Professional Development',
            size: '389 KB',
            date: '2024-06-20',
            status: 'completed',
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
                    <Select placeholder="All categories" w="180px">
                        <option value="transaction">Transaction</option>
                        <option value="listing">Listing</option>
                        <option value="client">Client</option>
                        <option value="marketing">Marketing</option>
                        <option value="inspection">Inspection</option>
                        <option value="financial">Financial</option>
                        <option value="professional">Professional</option>
                        <option value="training">Training</option>
                    </Select>
                    <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                        Upload Document
                    </Button>
                </HStack>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Document Name</Th>
                            <Th>Category</Th>
                            <Th>Related To</Th>
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
                                <Td fontSize="sm">{doc.relatedTo}</Td>
                                <Td fontSize="sm">{doc.size}</Td>
                                <Td fontSize="sm">{doc.date}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            doc.status === 'signed' ||
                                            doc.status === 'approved' ||
                                            doc.status === 'completed'
                                                ? 'green'
                                                : doc.status === 'active' || doc.status === 'published'
                                                ? 'blue'
                                                : 'yellow'
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
                                        <IconButton
                                            icon={<Trash2 size={16} />}
                                            size="sm"
                                            colorScheme="red"
                                            variant="ghost"
                                            aria-label="Delete document"
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
